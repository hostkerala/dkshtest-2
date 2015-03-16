<div class="view">

	<h1><?php echo CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl('/page/page/view', array('slug' => $data->slug))/*$data->permalink*/); ?></h1>

	<div class="content"><?php echo $data->content; ?></div>

</div>