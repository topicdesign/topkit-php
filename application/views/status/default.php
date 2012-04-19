<? foreach ($alerts as $type => $messages): ?>

<div data-type="<?= $type ?>" class="alert <?= 'alert-' . $type ?>" title="<?= ucfirst($type) ?>">
	
	<h6><?=ucfirst($type)?></h6>
	
	<ul>
	<? foreach ($messages as $m): ?>
	
		<li><?= $m ?></li>
		<? endforeach ?>

	</ul>

</div>

<? endforeach ?>
