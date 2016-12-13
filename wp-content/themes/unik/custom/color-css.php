<?php $unik_option=unik_options(); 
$unik_color= esc_attr($unik_option['site_color']); ?>
<style>
a {
  color: <?php echo $unik_color; ?>;
}
a:hover {
  color: <?php echo $unik_color; ?>;
}
.portfolio-item:hover {
  border: 8px solid <?php echo $unik_color; ?>;
}
.btn {
	background:<?php echo $unik_color; ?>;
  border: 1px solid <?php echo $unik_color; ?>;
}
.page-pre a,
.page-next a{
  border: 1px solid <?php echo $unik_color; ?>;
}
.page-pre a:hover,
.page-next a:hover{
	background-color:<?php echo $unik_color; ?>;
}
.navigation_menu{
	border-bottom: 4px solid <?php echo $unik_color; ?>;
}
#wp-calendar caption {
  background-color: <?php echo $unik_color; ?>;
}
.icon-color{
	color:<?php echo $unik_color; ?>;
}
.footer {
  border-top: 4px solid <?php echo $unik_color; ?>;
}
.form-control:focus{
	border-color: <?php echo $unik_color; ?>;
}
blockquote {
  border-left: 5px solid <?php echo $unik_color; ?>;
}
</style>