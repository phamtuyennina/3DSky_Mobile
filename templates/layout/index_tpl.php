<div class="wrap-show-product">
	<div class="container">
		<div class="row !-mx-[15px]">
			<div class="col-12 col-sm-12 col-md-9 !px-[15px]">
				<div class="title-pages">
					<h4>New Model</h4>
				</div>
				<div class="row_show_model">
					<div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='0' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
						<div class="col-model"><div class="block-col">
						<?php $i=0; foreach ($productnb as $k => $v) {$i++;?>
							<div class="box-model last:!mb-0">
								<a href="<?=$v['tenkhongdauvi']?>">
									<img class="img-block" onerror="this.src='<?=THUMBS?>/220x220x1/assets/images/noimage.png';" src="<?=THUMBS?>/220x220x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
									<div class="info-model">
										<h3 class="text-split-1"><?=$v['ten'.$lang]?></h3>
										<p class="show-social flex items-center">
											<span>
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
													<path d="M7.36175 11.1392C7.16342 11.2092 6.83675 11.2092 6.63842 11.1392C4.94675 10.5617 1.16675 8.15252 1.16675 4.06918C1.16675 2.26668 2.61925 0.80835 4.41008 0.80835C5.47175 0.80835 6.41092 1.32168 7.00008 2.11502C7.58925 1.32168 8.53425 0.80835 9.59008 0.80835C11.3809 0.80835 12.8334 2.26668 12.8334 4.06918C12.8334 8.15252 9.05342 10.5617 7.36175 11.1392Z" stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
												<i>350</i>
											</span>
											<span>
												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
													<path d="M14.0001 2.45015C14.0001 1.37318 13.127 0.500122 12.0501 0.500122C10.9731 0.500122 10.1001 1.37318 10.1001 2.45015C10.1001 3.52713 10.9731 4.40019 12.0501 4.40019C13.127 4.40019 14.0001 3.52713 14.0001 2.45015Z" stroke="#EAEAEA"/>
													<path d="M4.89998 6.99996C4.89998 5.92299 4.02694 5.04993 2.94999 5.04993C1.87304 5.04993 1 5.92299 1 6.99996C1 8.07693 1.87304 8.94999 2.94999 8.94999C4.02694 8.94999 4.89998 8.07693 4.89998 6.99996Z" stroke="#EAEAEA"/>
													<path d="M14.0001 11.5496C14.0001 10.4727 13.127 9.59961 12.0501 9.59961C10.9731 9.59961 10.1001 10.4727 10.1001 11.5496C10.1001 12.6266 10.9731 13.4997 12.0501 13.4997C13.127 13.4997 14.0001 12.6266 14.0001 11.5496Z" stroke="#EAEAEA"/>
													<path d="M10.0999 2.77551L4.57495 5.70056" stroke="#EAEAEA" stroke-linecap="round"/>
													<path d="M10.0999 11.2249L4.57495 8.2998" stroke="#EAEAEA" stroke-linecap="round"/>
												</svg>
												<i>250</i>
											</span>
										</p>
									</div>
								</a>
							</div>
						<?php if($i%2==0 && $k<=(count($productnb)-1) ){echo '</div></div><div class="col-model"><div class="block-col">';$i=0; }}?>
						</div></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-3 !px-[15px]">
				<div class="title-pages">
					<h4>Polygon Expert</h4>
				</div>
				<div class="show-slider-right">
					<div class="slick in-page" data-dots="0" data-infinite="1" data-arrows="0" data-autoplay='1' data-slidesDefault="2:1" data-lg-items='2:1' data-md-items='2:1' data-sm-items='2:1' data-xs-items="2:1" data-vertical="1">
						<?php foreach ($productnb1 as $k => $v) {?>
						<div class="right-model">
							<div class="box-model">
								<a href="<?=$v['tenkhongdauvi']?>">
									<img class="img-block" onerror="this.src='<?=THUMBS?>/290x290x1/assets/images/noimage.png';" src="<?=THUMBS?>/290x290x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
									<div class="info-model">
										<h3 class="text-split-1"><?=$v['ten'.$lang]?></h3>
										<p class="show-social flex items-center">
											<span>
												<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
													<path d="M7.36175 11.1392C7.16342 11.2092 6.83675 11.2092 6.63842 11.1392C4.94675 10.5617 1.16675 8.15252 1.16675 4.06918C1.16675 2.26668 2.61925 0.80835 4.41008 0.80835C5.47175 0.80835 6.41092 1.32168 7.00008 2.11502C7.58925 1.32168 8.53425 0.80835 9.59008 0.80835C11.3809 0.80835 12.8334 2.26668 12.8334 4.06918C12.8334 8.15252 9.05342 10.5617 7.36175 11.1392Z" stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
												<i>350</i>
											</span>
											<span>
												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
													<path d="M14.0001 2.45015C14.0001 1.37318 13.127 0.500122 12.0501 0.500122C10.9731 0.500122 10.1001 1.37318 10.1001 2.45015C10.1001 3.52713 10.9731 4.40019 12.0501 4.40019C13.127 4.40019 14.0001 3.52713 14.0001 2.45015Z" stroke="#EAEAEA"/>
													<path d="M4.89998 6.99996C4.89998 5.92299 4.02694 5.04993 2.94999 5.04993C1.87304 5.04993 1 5.92299 1 6.99996C1 8.07693 1.87304 8.94999 2.94999 8.94999C4.02694 8.94999 4.89998 8.07693 4.89998 6.99996Z" stroke="#EAEAEA"/>
													<path d="M14.0001 11.5496C14.0001 10.4727 13.127 9.59961 12.0501 9.59961C10.9731 9.59961 10.1001 10.4727 10.1001 11.5496C10.1001 12.6266 10.9731 13.4997 12.0501 13.4997C13.127 13.4997 14.0001 12.6266 14.0001 11.5496Z" stroke="#EAEAEA"/>
													<path d="M10.0999 2.77551L4.57495 5.70056" stroke="#EAEAEA" stroke-linecap="round"/>
													<path d="M10.0999 11.2249L4.57495 8.2998" stroke="#EAEAEA" stroke-linecap="round"/>
												</svg>
												<i>250</i>
											</span>
										</p>
									</div>
								</a>
							</div>
						</div>	
						<?php }?>
					</div>
				</div>
				<div class="button-upload">
					<button type="button">
						<span>UPLOAD MODEL</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="show_list_dnhmuc">
	<div class="container">
		<ul class="mansory-list row">
			<?php foreach($splistmenu as $k => $v){
				$spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id']));
			?>
			<li class="col-12 col-sm-6 col-md-3 mb-5 col-item">
				<p>
					<a href="3d-models?list=<?=$v['tenkhongdauvi']?>">
						<span>
							<img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
						</span>
						<?=$v['ten']?>
					</a>
				</p>
				<?php if(!empty($spcatmenu)){?>
				<div class="show_cat">
					<?php foreach($spcatmenu as $k_cat => $v_cat){?>
					<p><a href="3d-models?list=<?=$v['tenkhongdauvi']?>&cat=<?=$v_cat['tenkhongdauvi']?>"><?=$v_cat['ten']?></a></p>	
					<?php }?>
				</div>
				<?php }?>
			</li>	
			<?php }?>
		</ul>
	</div>
</div>