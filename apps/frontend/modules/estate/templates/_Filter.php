<div class="bloco">
	<?php echo $form->renderFormTag(url_for(sfConfig::get('app_route_form_filter')), ['method' => 'post','class' => 'frmBusca frm','id'=>'frmBuscaImoveis']) ?>
	<?php echo $form->renderHiddenFields(); ?>
		<div class="gs gs--flex">
			<div class="consulta__main consulta__main--first">
				<?php echo $form['Disponibilidades']->render(); ?>
			</div>
			<div class="consulta__main">
				<?php echo $form['type_id']->render(); ?>
			</div>
			<div class="consulta__main">
				<?php echo $form['neighborhood_id']->render(); ?>
			</div>
		</div>

		<div class="gs gs--flex">
			<?php $consultaItem = $consultaItem->getRawValue(); ?>
			<?php foreach ($consultaItem as $v): ?>
				<?php
					$svg = $v['svg'];
					$isArray = is_array($v['field']);
					$field = $isArray ? $v['field'][0] : $v['field'];
					$css = $v['css'];
				?>
				<div class="consulta__item">
					<button type="button" class="btn--drop">
						<svg class="icon">
							<use xlink:href="<?php echo $svg ?>"></use>
						</svg>
						<span><?php echo $form[$field]->renderLabel(); ?></span>
						<span id="<?php echo "{$field}Choices" ?>">...</span>
					</button>
					<div class="opts <?php echo $css ?>" data-field="<?php echo $field ?>">
						<?php if ($isArray): ?>
							<div class="pad-30">
								<div id="<?php echo "{$field}Slider" ?>"></div>
							</div>
						<?php else: ?>
							<?php echo $form[$field]->render(); ?>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach ?>
		</div>

		<div class="gs gs--flex">
			<button type="submit" class="btn--submit">
				<svg class="icon--btn"><use xlink:href="#material_search">Encontrar</use></svg>
				<span>Encontrar</span>
			</button>
		</div>

	</form>
</div>
