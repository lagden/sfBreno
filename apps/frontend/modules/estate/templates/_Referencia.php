
<?php echo $form->renderFormTag(url_for('estate_referencia'),['method'=> 'post', 'class'=> 'frmRef frm formTrigger', 'id'=> 'frmBuscaImoveisRef']) ?>
	<div class="gs gs--flex">
		<div class="referencia--item">
			<?php echo $form['referencia']->render(['title'=>$form['referencia']->renderLabelName()]); ?>
		</div>
		<button type="submit" class="btn--submit-ref">
			<svg class="icon--btn"><use xlink:href="#material_search">Encontrar</use></svg>
			<span>OK</span>
		</button>
	</div>
</form>
