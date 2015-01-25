<?php

if ($model->show_hidden)
return <<<T
    <div id="div-{$model->id}" class="pbp-card"><p>{$model->attr}</p>{$model->text}</div></span>
T;

else
return <<<T

<span class='pbp-container'>
    <span id="{$model->id}" title="{$model->content}" class='pbp-card-handle'>{$model->content}</span>
    <div id="div-{$model->id}" class='pbp-card--hidden' ><p>{$model->attr}</p>{$model->text}</div>
</span>
T;

