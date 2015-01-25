<?php
if ( $model->show_hidden ) {?>
<div id="div-<?php echo htmlspecialchars($model->id, ENT_QUOTES) ?>" class="pbp-card"><p><?php echo htmlspecialchars($model->attr, ENT_QUOTES) ?></p><?php echo htmlspecialchars($model->text, ENT_QUOTES) ?></div></span>;

<?php } else { ?>

<span class='pbp-container'>
    <span id="<?php echo htmlspecialchars($model->id, ENT_QUOTES) ?>" title="<?php echo htmlspecialchars($model->content, ENT_QUOTES) ?>" class='pbp-card-handle'><?php echo htmlspecialchars($model->content, ENT_QUOTES) ?></span>
    <div id="div-<?php echo htmlspecialchars($model->id, ENT_QUOTES) ?>" class='pbp-card--hidden' ><p><?php echo htmlspecialchars($model->attr, ENT_QUOTES) ?></p><?php echo htmlspecialchars($model->text, ENT_QUOTES) ?></div>
</span>

<?php }?>



