<div class="table-responsive-md wow fadeIn">
    <table class="table xs-table">
        <thead class="domain-pricing-header">
            <tr>
                <?php if($items[0]['name'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['name']);?></th>
                <?php endif; ?>
                <?php if($items[0]['register'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['register']);?></th>
                <?php endif; ?>
                <?php if($items[0]['transfer'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['transfer']);?></th>
                <?php endif; ?>
                <?php if($items[0]['renew'] !=''): ?>
                    <th scope="col"><?php echo esc_html($items[0]['renew']);?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($items as $item){ if($i > 1){ ?>
                <tr>
                    
                    <th scope="row">
                        <?php 
                        if($item['use_tld_img']=='yes'):
                            if($item['icon']['url'] !=''): ?>
                                <img src="<?php echo esc_html($item['icon']['url']);?>" alt="<?php esc_attr_e('domain name com icon','hostinza');?>">
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="tld-name"><?php echo esc_html($item['name']);?></p>
                        <?php endif; ?>
                    </th>
                    
                    <?php if($item['register'] !=''): ?><td><?php echo hostinza_kses(sprintf($item['register'], '<del>', '</del>' ) ); ?></td><?php endif; ?>
                    <?php if($item['transfer'] !=''): ?><td><?php echo hostinza_kses(sprintf($item['transfer'], '<del>', '</del>' ) ); ?></td><?php endif; ?>
                    <?php if($item['renew'] !=''): ?><td><?php echo hostinza_kses(sprintf($item['renew'], '<del>', '</del>' ) ); ?></td><?php endif; ?>
                </tr>

            <?php } $i++; } ?>


        </tbody>
    </table>
</div>