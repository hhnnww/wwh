<?php
    function res(){
        if($_GET['res']=="ok"){
            $res = array(
                'class'=>'alert-success',
                'zt'=>'ok',
                'text'=>''
            );
        }else{
            $res = array(
                'class'=>'alert-light',
                'zt'=>'no',
                'text'=>''
            );
        }
        return $res;
    }
?>

<div class="widget">

    <div class="row">
        <div class="col">
            
                <div class="yuding p-4 bg-white" id="#yuding">

                    <?php if(get_post_meta(get_the_ID(),'price')){ ?>
                    <div class="jiage mb-3 border-bottom border-light pb-2">
                        <b class="mr-2"><?php echo get_post_meta(get_the_ID(),'price')[0];?></b><span>起/人</span>
                    </div>
                    <?php } ?>

                    <div class="biaodan">
                        <?php if(!in_category('线路')):?>
                        <div class="bt font-weight-bold mb-2 border-bottom border-light pb-2">联系我们线上导游</div>
                        <?php endif;?>
                        <!-- <form id="yd-form" action="<?php echo get_template_directory_uri();?>/inc/yuding.php" method="post"> -->

                        <div class="form-group">
                            <label for="name">联系人姓名</label>
                            <input type="text" class="form-control" name="yd-name" id="yd-name">
                        </div>

                        <input type="text" name="yd-url" id="yd-url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" class="d-none">

                        <div class="form-group">
                            <label for="phone">微信号或手机</label>
                            <input type="text" class="form-control" name="yd-phone" id="yd-phone">
                        </div>

                        <div class="form-group">
                            <label for="phone">简短计划</label>
                            <textarea style="resize:none;" name="yd-jihua" id="yd-jihua" name="yd-jihua" class="form-control" cols="30" rows="5"></textarea>
                        </div>

                        <button class="btn-wwh hvr-sweep-to-right d-block w-100" onclick="tijiao()">提交</button>

                        <div id="info" class="alert small mt-3 text-center alert-light">
                            线上预订无需支付金额，预定后会后导游电话或微信联系您二次确认。
                        </div>
                    </div>

                    <div class="baozheng mt-3">
                        <div class="d-flex justify-content-center">
                            <div class="item">TOP品牌</div>
                            <div class="item mx-3">金牌售后</div>
                            <div class="item">无忧纯玩</div>
                        </div>
                    </div>

                    <div class="weixin text-center mt-4">
                        <a href="#" class="text-muted" data-target="#jiawei" data-toggle="modal">点击添加导游微信，了解此产品优惠信息</a>
                    </div>

                </div><!--- yuding --->
                
                <!-- 二次确认 -->
                <div class="erciqueren d-flex bg-white p-3 mt-3 border border-light">
                    <div class="bt font-weight-bold mr-2">二次<br />确认</div>
                    <div class="text text-muted">为了您的出行保障，本产品需要二次确认, 我们将在1个工作日内核实是否有库存。</div>
                </div>
            
        </div>
    </div>

</div>