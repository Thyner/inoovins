<div class="table-responsive">
    <table class="table table-striped server-price-table">
        <thead>
            <tr>
                <?php if($items[0]['processor'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['processor']);?></th>
                <?php endif; ?>
                <?php if($items[0]['memory'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['memory']);?></th>
                <?php endif; ?>
                <?php if($items[0]['storage'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['storage']);?></th>
                <?php endif; ?>
                <?php if($items[0]['transfer'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['transfer']);?></th>
                <?php endif; ?>
                <?php if($items[0]['price'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['price']);?></th>
                <?php endif; ?>
                <?php if($items[0]['deploy'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['deploy']);?></th>
                <?php endif; ?>
                <?php if($items[0]['availability_label'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['availability_label']);?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($items as $item){ if($i > 1){ ?>
                <tr>
                    <th scope="row"><?php if($item['sale'] !=''): ?><span class="tag"><?php echo esc_html($item['sale']);?></span><?php endif; if($item['new'] !=''): ?><span class="tag featured"><?php echo esc_html($item['new']);?></span><?php endif; if($item['processor'] !=''): echo esc_html($item['processor']);?> </th><?php endif; ?>
                    <?php if($item['memory'] !=''): ?><td><?php echo esc_html($item['memory']);?></td><?php endif; ?>
                    <?php if($item['storage'] !=''): ?><td><?php echo esc_html($item['storage']);?></td><?php endif; ?>
                    <?php if($item['transfer'] !=''): ?><td><?php echo esc_html($item['transfer']);?></td><?php endif; ?>
                    <?php if($item['price'] !=''): ?><td><span class="price"><del><?php echo esc_html($item['price_old']);?></del> <?php echo esc_html($item['price']);?></span></td><?php endif; ?>
                    <?php if($item['deploy'] !=''): ?><td><?php echo esc_html($item['deploy']);?></td><?php endif; ?>
                    <?php if($item['availability_label'] !=''): ?><td><a href="<?php echo esc_url($item['url']['url']);?>" class="featured <?php if($item['availability'] == ''){ echo 'disabled'; } ?>"><?php echo esc_html($item['availability_label']);?></a></td><?php endif; ?>
                </tr>
            <?php } $i++; } ?>
        </tbody>
    </table>
</div>