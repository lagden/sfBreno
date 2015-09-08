import ModalLayout from 'modal-layout/modal/modal';

const estateDetalhe = window.document.querySelector('#estateDetalhe');

if (estateDetalhe) {
	const ativo = parseInt(estateDetalhe.dataset.ativo, 10);
	if (ativo === 0) {
		const m = new ModalLayout('<div><b>Atenção:</b> Imóvel inativo! </div>');
		m.open();
		m.box.addEventListener('click', m.close.bind(m), false);
	}
}
