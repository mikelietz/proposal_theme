<article id="post-<?php echo $content->id; ?>" class="post" itemscope itemtype="http://schema.org/BlogPosting">

	<?php if(!$request->display_home): ?>
	<header>
		<h1 itemprop="name"><a href="<?php echo $content->permalink; ?>" itemprop="url"><?php echo $content->title_out; ?></a></h1>
	</header>
	<?php endif; ?>

	<section class="content" itemprop="articleBody">
		<?php echo $content->content_out; ?>
	</section>

</article>
