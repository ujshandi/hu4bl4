<div id="rt">
    <div class="center_content">
        <div class="page_title"><h1>FAQ</h1></div>
        <hr/>
        <ul id="faq">
                <? if($faqs){foreach ($faqs->result() as $faq) :?>
                <li>
                    <h3><a href="#"><?=$faq->content?></a></h3>
                    <img src="<?=base_url();?>public/images/portal/ans-icon.png" /><p>"<?=$faq->summary?>"</p>
                </li>
                <? endforeach;}else echo '<h1>Saat ini data FAQ masih kosong</h1>';?>
            </ul>
        <div class="clear"></div>
    </div><!-- end center content -->
</div><!--end block right-->