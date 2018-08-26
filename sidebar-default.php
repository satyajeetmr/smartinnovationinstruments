<?php 
 $sidebar_html='';
if( have_rows('page_links', 'option') ): 
 global $post; $get_child = '';
	 $sidebar_html.='<ul>';
		$i = 1; 
		while( have_rows('page_links', 'option') ): the_row(); 
		$curr_page_id = $post->ID;
		$parent_page_id = $post->post_parent;
		$page_id = get_sub_field('page_title'); 
		$pre_links[] = $page_id;
		$page = get_post($page_id);
		if($page->post_parent > 0 && in_array($page->post_parent, $pre_links)){
			if($curr_page_id == $page_id){
				$selcted_child = 'level2 selected';
			}else{
				$selcted_child = 'level2';
			}
			$curr_page_id = $page->post_parent;
		}
		
		if($curr_page_id == $page_id || $page_id == $parent_page_id){
			$selcted = 'level1 selected';
			$get_child = 'yes';
		}else{
			$selcted = 'level1';
		}
		if($page->post_parent > 0 && in_array($page->post_parent, $pre_links)){
			if($get_child==''){continue;}
		
			$sidebar_html.='<li class="'.$selcted_child.'"><a href="'.get_permalink($page_id).'" target="">'.get_the_title($page_id).'</a></li>';
		 }else{ 
			$sidebar_html.='<li class="'.$selcted.'"><a href="'.get_permalink($page_id).'" target="">'.get_the_title($page_id).'</a></li>';
		 }
		 $i++; endwhile; 
	$sidebar_html.='</ul>';
 endif; ?>
<aside class="icobalt ilayout" id="SideZone">
<?php $choose_side_bar = get_field('choose_side_bar');
if(!empty($choose_side_bar) && $choose_side_bar =='c_down'){
?>
<aside class="side-nav-panel v20 light" id="SideNavV20">
<nav class="practice-nav" id="SideNavV20Nav">
<header>
<?php the_field('left_sidebar_content_title', 'option'); ?>
</header>

<?php echo $sidebar_html;?>

</nav>
</aside>
<?php }?>
<section class="contact-form-panel v1 section" id="ContactFormPanelV1Fix">
	<div class="main">
		<div class="contact-box">
			<header id="ContactFormHeaderV1"><?php the_field('consultation_form_title', 'option'); ?></header>
			<div id="ContactFormPanelV1Form">
				<fieldset data-item="i" data-key="">
					<?php the_field('consultation_form_shortcode', 'option'); ?>
				</fieldset>
			</div>
		</div>
	</div>
</section>

<?php
if(!empty($choose_side_bar) && $choose_side_bar =='c_up'){
?>
<aside class="side-nav-panel v20 light" id="SideNavV20">
	
	<nav class="practice-nav" id="SideNavV20Nav">
		<header>
			<?php the_field('left_sidebar_content_title', 'option'); ?>
		</header>
		<?php echo $sidebar_html;?>
	</nav>
</aside>
<?php }?>
</aside>