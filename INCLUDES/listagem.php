<?php
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
        default:
            # code...
            break;
    }
}
?>

<?php if ($mensagem != '') { ?>
    <section>
        <?php echo $mensagem; ?>
    </section>
<?php } ?>

    </script>
<section>
    <form method="get">
        <div class="row">
            <div class="col">
                <label>Filtrar Id</label>
                <select class="form-control" name="filtro" id="filtro" value="">
                <?php foreach($listaVaga as $key => $value) { ?>
                    <option value="<?php echo $value->id; ?>" <?php echo $obVaga->id == $value->id ? "selected" : '' ;?>> <?php echo $value->id; ?></option>
                <?php } ?>
            </select>
            </div>
        </div>
    </form>
</section>
    <script>

      //Filter 
$('#filtro').change(function() {
	var filter = $(this).val();
	filterList(filter);
});

//  filter function
function filterList(value) {
	var list = $(".cards .card");
	$(list).hide();
	if (value == "0") {
		$(".cards").find(".card").each(function (i) {
			$(this).show();
		});
    } else {
		$(".cards").find(".card[data-custom-type*=" + value + "]").each(function (i) {
			$(this).show();
		});
	}
}


        </script>
<section>
    <a href="cadastrar">
        <button class="btn btn-success mt-3">Cadastrar</button>
    </a>

    <?php if (count($vagas) == 0) { ?>
        <div class="alert alert-secondary mt-3">Nenhuma vaga encontrada</div>
    <?php } else { ?>
                <?php foreach ($vagas as $key => $value) { ?>
                    <section class="cards">
                    <div class="card bg-dark mt-3" data-custom-type="<?php echo $value->id; ?>" id="table-listagem" >
                <h5 class="card-header"><?php echo $value->titulo; ?></h5>
                <div class="card-body" id="myTable">
                    <h5 class="card-title">Id:<?php echo $value->id; ?></h5>
                    <p class="card-text">Descrição<?php echo $value->descricao; ?><br>
                        Data:<?php echo $value->data; ?><br>
                        Status:<?php echo ($value->status == 's' ? 'Ativo' : 'Inativo'); ?><br>
                    </p>
                    <a href="editar.php?id=<?php echo $value->id; ?>" style="margin-right:10px;">
                        <button type="button" class="neon-bt3 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" style="margin-left:43%;" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>
                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>
                        </button>
                    </a>

                    <a href="excluir.php?id=<?php echo $value->id; ?>" style="margin-right:10px;">
                        <button type="button" class="neon-bt2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" style="margin-left:43%;" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span></button>
                    </a>
                </div>
            </div>
            </section>
        <?php } ?>
    <?php } ?>
</section>