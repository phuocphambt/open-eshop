<?php defined('SYSPATH') or die('No direct script access.');?>

<h2><?=$product->title?></h2>

    <?if($product->get_first_image() !== NULL):?>
    <div class="thumbnail">
        <a title="<?= $product->title;?>" href="<?=Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>">
            <img src="<?=URL::base('http')?><?=$product->get_first_image()?>" class="" >
        </a>
    </div>
    <?endif?>

<?if ($product->has_offer()):?>
    <span class="label label-success"><?=__('Offer')?> <?=$product->final_price().' '.$product->currency?> <del><?=$product->price.' '.$product->currency?></del></span>
    <p><?=__('Offer valid until')?> <?=Date::format($product->offer_valid)?></p>
<?else:?>
    <?if($product->final_price() != 0):?>
        <span class="label mb-20"><?=$product->final_price().' '.$product->currency?></span>
    <?else:?>
        <span class="label label-success mb-20"><?=__('Free')?></span>
    <?endif?>
<?endif?>

<div>
<?if ($product->final_price()>0):?>
    <a class="btn btn-success btn-large" 
        href="<?=Route::url('default', array('controller'=>'paypal','action'=>'pay','id'=>$product->seotitle))?>">
        <?=__('Pay with Paypal')?></a>

    <?=Paymill::button($product)?>
<?else:?>
    <?if (!Auth::instance()->logged_in()):?>
    <a class="btn btn-info btn-large" data-toggle="modal" data-dismiss="modal" 
        href="<?=Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'register'))?>#register-modal">
    <?else:?>
    <a class="btn btn-info btn-large"
        href="<?=Route::url('oc-panel',array('controller'=>'profile','action'=>'free_download','id'=>$product->seotitle))?>">
    <?endif?>
        <?=__('Free Download')?>
    </a>
<?endif?>
</div>

<div class="well">
    <?=Text::bb2html($product->description,TRUE)?>

    <span class="label label-info mb-20"><i class="icon-eye-open icon-white"></i> <?=$hits?></span>
    <?if (!empty($product->file_name)):?>
    <span class="label label-info mb-20">
        <?=strtoupper(strrchr($product->file_name, '.'))?> <?=__('file')?> 
        <?=round(filesize(DOCROOT.'data/'.$product->file_name)/pow(1024, 2),2)?>MB 
    </span>
    <?endif?>

    <?if ($product->support_days>0):?>
    <span class="label label-info">
    <?=$product->support_days?> <?=__('days professional support')?>
    </span>
    <?endif?>

    <?if ($product->licenses>0):?>
    <span class="label label-info">
    <?=$product->licenses?> <?=__('licenses')?> 
        <?if ($product->license_days>0):?>
            <?=$product->license_days?> <?=__('days valid')?>
        <?endif?>
    </span>
    <?endif?>
</div>