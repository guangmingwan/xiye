<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>
<br />
<center>
	<?php echo adshow('footerbanner//1').adshow('footerbanner//2').adshow('footerbanner//3'); ?>
	<div id="footer">
		Powered by <strong>Discuz! <?php echo $_G['setting']['version']; ?> Archiver</strong> &nbsp; &copy 2014 Comsenz Inc.  & ÕıÉùÂÛÌ³
		<br />
		<br />
	</div>
</center>
</body>
</html>
<?php output(); ?>