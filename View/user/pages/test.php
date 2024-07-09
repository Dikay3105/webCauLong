<div class="select-swatch">
                            <div class="swatch clearfix">
                                <div class="header">Chọn phiên bản: </div>
                                <?php foreach ($listracket as $listracket): ?>
                                    <?php if ($listracket->getQuantity()>0): ?>
                                        <div class="swatch-element type-<?php echo $listracket->getColor(); ?>" data-value="<?php echo $listracket->getColor(); ?>" data-value_2="<?php echo $listracket->getColor(); ?>">
                                        <input id="color-<?php echo $listracket->getColor(); ?>" type="radio" name="color" value="<?php echo $listracket->getColor(); ?>">
                                    <?php else: ?>
                                        <div class="swatch-element soldout color-<?php echo $listracket->getColor(); ?>" data-value="<?php echo $listracket->getColor(); ?>" data-value_2="<?php echo $listracket->getColor(); ?>">
                                        <input disabled id="color-<?php echo $listracket->getColor(); ?>" type="radio" name="color" value="<?php echo $listracket->getColor(); ?>">
                                    <?php endif; ?>   
                                        <label for="color-<?php echo $listracket->getColor(); ?>">
                                            <?php echo $listracket->getColor(); ?>
                                            <img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="<?php echo $listracket->getColor(); ?>">
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        </div>