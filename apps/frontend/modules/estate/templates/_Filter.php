<div class="bloco">
	<?php echo $form->renderFormTag(url_for(sfConfig::get('app_route_form_filter')), ['method' => 'post','class' => 'frmBusca frm','id'=>'frmBuscaImoveis']) ?>
		<?php /*
		<ul>
			<li>
				<?php echo $form['type_id']->renderLabel(); ?>
				<?php echo $form['type_id']->render(); ?>
			</li>
			<li>
				<?php echo $form['Disponibilidades']->renderLabel(); ?>
				<?php echo $form['Disponibilidades']->render(array('title'=>$form['Disponibilidades']->renderLabelName(),'class'=>'required','data-url'=>url_for('estate_disponibilidade'))); ?>
			</li>
			<li id="bairros_inline_content">
				<?php echo $form['neighborhood_id']->renderLabel(); ?>
				<?php echo content_tag('button', 'Mostrar os bairros', array('type' => 'button', 'class' => 'btn orange button showBairro', "data-href"=>"#bairros_inline")) ?>
				<div id="bairros_inline">
					<h2>Selecione os bairros</h2>
					<?php echo $form['neighborhood_id']->render(); ?>
					<div class="somePadding ptop">
						<?php echo content_tag('button', 'OK', array('class' => 'btn orange button closeBairro')) ?>
					</div>
				</div>
			</li>
		</ul>
		*/ ?>

		<div class="gs gs--flex">
			<?php foreach ($consultaItem as $v): ?>
				<?php
					$svg = $v['svg'];
					$field = $v['field'];
					$css = $v['css'];
				?>
				<div class="consulta__item">
				  <button type="button" class="btn-drop">
				    <svg class="icon">
				      <use xlink:href="<?php echo $svg ?>"></use>
				    </svg>
				    <span><b id="<?php echo "{$field}Badge" ?>"class="mdl-badge"><?php echo $form[$field]->renderLabel(); ?></b></span>
				  </button>
				  <div class="opts <?php echo $css ?>" data-field="<?php echo $field ?>">
				  	<?php echo $form[$field]->render(); ?>
				  </div>
				</div>
			<?php endforeach ?>
		</div>
		<?php  /*
		<div class="gs">
			<?php echo content_tag('button', 'Encontrar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
		</div>
		*/?>
	</form>
</div>
