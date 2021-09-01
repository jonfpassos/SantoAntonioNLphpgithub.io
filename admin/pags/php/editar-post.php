<div class="panel-content">
    <h4 class="titulo">EDITAR PUBLICAÇÃO</h4>
          
    <form method="POST" enctype="multipart/form-data">
        <p><label for="titulo">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo getDadosPost($explode[1], "Titulo_Posts");?>">
        </p>

        <p>
            <textarea class="form-control" id="post" name="post" rows="5"><?php echo getDadosPost($explode[1], "Postagem_Posts");?></textarea>
        </p>

        <p><label>Categoria</label>
            <select class="form-control" name="categoria">
               <?php getCategoriaAtual(getDadosPost($explode[1], "Categoria_Posts")); get_categorias();?>
            </select>
        </p>

        <p><input type="submit" value="Alterar" class="btn btn-primary btn-lg btn-block">
            <input type="hidden" name="env" value="alt">
        </p>
    </form>
    <?php editarPost($explode[1]);?>
</div>