<?php
/**
 * @var $this yii\web\View
 * @var $versions array all available API versions
 * @var $version string the currently chosen API version
 * @var $section string the currently active API file
 */
use app\components\DropdownList;
use app\models\Guide;
use yii\helpers\Html;

?>
<nav class="version-selector" role="navigation">
    <div class="btn-group btn-group-justified">
	    <?php
	        $guide = Guide::load($version, 'en');
			$items = [];
			if ($guide->getDownloadFile('tar.gz') !== false) {
				$items[] = [
					'label' => 'Offline HTML (tar.gz)',
					'url' => ['guide/download', 'version' => $guide->version, 'language' => $guide->language, 'format' => 'tar.gz'],
				];
			}
			if ($guide->getDownloadFile('tar.bz2') !== false) {
				$items[] = [
					'label' => 'Offline HTML (tar.bz2)',
					'url' => ['guide/download', 'version' => $guide->version, 'language' => $guide->language, 'format' => 'tar.bz2'],
				];
			}
			if (!empty($items)) {
				echo DropdownList::widget([
					'tag' => 'div',
					'selection' => 'Download',
					'items' => $items,
					'options' => [
						'class' => 'btn-group btn-group-sm'
					]
				]);
			}
		?>
        <?= DropdownList::widget([
            'tag' => 'div',
            'selection' => "Version {$version}",
            'items' => array_map(function ($ver) use ($version, $section) {
                return [
                    'label' => $ver,
                    'url' => ['api/view', 'version' => $ver, 'section' => ($version[0] === $ver[0]) ? $section : 'index'],
                ];
            }, $versions),
            'options' => [
                'class' => 'btn-group btn-group-sm'
                ]
        ]) ?>
    </div>
</nav>
