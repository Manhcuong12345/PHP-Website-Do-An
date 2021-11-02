<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_post)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_post as $item) {
                                ?>
                                <li class="clearfix">
                                    <a href="<?php echo "post/" . $item['slug'] . "-" . $item['id']; ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo $item['post_thumbnail']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo "post/" . $item['slug'] . "-" . $item['id']; ?>" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo time_format($item['created_date']); ?></span>
                                        <p class="desc"><?php echo $item['post_desc']; ?></p>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, "", "posts"); ?>
                </div>
            </div>
        </div>
        <?php get_sidebar('post'); ?>
    </div>
</div>
<?php
get_footer();
?>