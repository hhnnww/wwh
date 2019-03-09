<?php wp_footer();?>

<div class="footer bg-dark py-4 text-muted">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                © Copyright
                <?php bloginfo('name');?>
                <?php echo date('Y');?> <span class="mx-2">|</span> <img src="<?php echo get_template_directory_uri();?>/img/beian-icon.png"
                    width="15" style="margin-top:-5px;" /> 新公安网备XJ-00189867号
            </div>
        </div>
        <div class="col-12 text-center mt-2">
            本站所有内容均来源于网络，如有侵权，可联系我们站长QQ：175990271，我们将会在第一时间删除。诚招友联，可联系QQ：175990271
        </div>
    </div>
</div>

<?php modal_jiawei();?>
<script src="<?php echo get_template_directory_uri();?>/inc/main.js"></script>
</body>

</html>