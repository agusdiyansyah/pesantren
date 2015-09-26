$(document).ready(function() {
	render(date, '.box-body');
	total('.info-debit .inner h3', debit);
	total('.info-kredit .inner h3', kredit);
	total('.info-saldo .inner h3', saldo);
});