<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
<script language="JavaScript" type="text/javascript"><!--
if (document.layers && navigator.javaEnabled()) {
    netscape.security.PrivilegeManager.enablePrivilege('UniversalFileRead');

    document.myForm.myFile.value = "/mnt/d/temp/DSCN4095s.jpg";
}
//--></script>

</body>
</html>
