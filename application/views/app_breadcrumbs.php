
<?php
$uri 	= $this->uri->segment(1);
$uri2	= $this->uri->segment(2);

?>
<div class="col-sm-12">
    <div class="page-header float-right">
        <div class="page-title">
            <ol class="breadcrumb text-right">
                <li><?=$uri;?></li>
                <li><?=$uri2;?></li>
            </ol>
        </div>
    </div>
</div>