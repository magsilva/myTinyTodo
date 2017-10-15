<?php
$hash = sha1(Config::get('password') . Config::get('username') . @$_SERVER['SERVER_ADDR'] . @$_SERVER['HTTP_HOST']);
if (Config::get('password') == '' || (isset($_COOKIE['MTTAUTH']) && $_COOKIE['MTTAUTH'] == $hash) || (isset($_POST['pasword']) && isset($_POST['user']) && $_POST['pasword'] == Config::get('password') && $_POST['user'] == Config::get('username'))) {
    session_regenerate_id(1);
    $_SESSION['logged'] = 1;
    if (isset($_POST['stay_loggedin']) && $_POST['stay_loggedin'] == 1) {
        setcookie('MTTAUTH', $hash, time() + 60 * 60 * 24 * 30 * 3);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
} else {
    header('Content-type: text/html; charset=utf-8');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php mttinfo('title'); ?></title>
    <link rel="stylesheet" type="text/css"
          href="<?php mttinfo('template_url'); ?>style.css?v=<?php echo Config::get('version'); ?>"
          media="all"/>
    <?php if (Config::get('rtl')): ?>
        <link rel="stylesheet" type="text/css"
              href="<?php mttinfo('template_url'); ?>style_rtl.css?=<?php echo Config::get('version'); ?>"
              media="all"/>
    <?php endif; ?>
    <meta name="viewport" id="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css"
          href="<?php mttinfo('template_url'); ?>pda.css?v=<?php echo Config::get('version'); ?>"
          media="all"/>

    <style>body {
            margin-top: 0;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 0;
            width: 960px;
            padding-top: 50px
        }

        .login-form {
            margin: 50px auto;
        }</style>
</head>

<body>
<div class="login-form">
    <h2><?php mttinfo('title'); ?></h2>

    <form accept-charset="UTF-8" id="loginForm" method='POST' action='<?php echo @$_SERVER['REQUEST_URI']; ?>'>
        <input type="text" id="user" name="user" placeholder="<?php _e('set_user'); ?>"/>
        <input type='password' id='password' name='pasword' placeholder="<?php _e('password'); ?>"/>
         <span>
            <input type="checkbox" name="checkbox" value='1'>
            <label for="checkbox"><?php _e('stay_loggedin'); ?></label>
        </span>
        <input type='submit' value='<?php _e('btn_login'); ?>'/>
    </form>
</div>
<div id="page_ajax" style="display:none"></div>

</div>
<div id="space"></div>
</div>

<div id="footer">
    <div id="footer_content">Powered by <strong><a
                href="http://www.mytinytodo.net/">myTinyTodo</a></strong> <?php echo Config::get('version'); ?> </div>
</div>
</div>
</body>
</html>
