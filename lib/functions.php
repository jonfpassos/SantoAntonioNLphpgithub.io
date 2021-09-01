<?php

    function pdo()
    {
        $db_host = db_host;
        $db_usuario = db_usuario;
        $db_senha = db_senha;
        $db_banco = db_banco;
        try
        {
            return $pdo = new PDO("mysql:host={$db_host};dbname={$db_banco}", $db_usuario, $db_senha);;

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e)
        {
            exit("Erro ao conectar-se ao banco: ".$e->getMessage());
        }
    }

    function paginacao_adm()
    {
        $url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'dashboard';
		$explode = explode('/', $url);
		$dir = 'pags/php/';
		$ext = '.php';

        if(file_exists($dir.$explode[0].$ext) && isset($_SESSION['admLogin']))
        {
            include($dir.$explode[0].$ext);
        }else
        {
            include($dir."login".$ext);
        }

    }

    function alerta($tipo, $mensagem)
    {
		echo "<div class='alert alert-{$tipo}'>{$mensagem}</div>";
	}

    function redireciona($tempo, $dir)
    {
		echo "<meta http-equiv='refresh' content='{$tempo}; url={$dir}'>";
	}

    function logIn()
    {
        if(isset($_POST['log']) && $_POST['log'] == "in")
        {
           $pdo = pdo();

           $stmt = $pdo->prepare("SELECT * FROM tbluser WHERE Usuario_User = :usuario");
           $stmt->execute([':usuario' => $_POST['usuario']]);
	       $total = $stmt->rowCount();
           

           if($total > 0)
           {
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                if(password_verify($_POST['senha'], $dados['Senha_User']))
                {
					$_SESSION['admLogin'] = $dados['Usuario_User'];
					header('Location: dashboard');
				}
                else
                {
					alerta("danger", "Usuário ou senha inválidos");
				}
                
           }
           else
           {
            alerta("danger", " $total  Total < 0");
           }
        }
    }

    function verificaLogin()
    {
        if(isset($_SESSION['admLogin']))
        {
            header('Location: dashboard');
            exit();
        }
    }

    function getDadosUser($var)
    {
        if(isset($_SESSION['admLogin']))
        {
            $pdo = pdo();
            $stmt = $pdo->prepare("SELECT * FROM tbluser WHERE Usuario_User = :usuario");
            $stmt->execute([':usuario' => $_SESSION['admLogin']]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dados[$var];
        }
    }

    function get_categorias()
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("SELECT * FROM tblcategoria ORDER BY Cat_Categoria ASC");
        $stmt->execute();
		$total = $stmt->rowCount();

        if($total > 0)
        {
            while($dados = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo "<option value='{$dados['ID_Categoria']}'>{$dados['Cat_Categoria']}</option>";
            }
        }
    }

    function tirarAcentos($string)
    {
	    return strtolower(str_replace(" ","-", preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç)/","/(#)/","/\+/","/\!/","/\?/"),explode(" ","a A e E i I o O u U n N C "),$string)));
	}

    function getData()
    {
		date_default_timezone_set('America/Sao_Paulo');
		return date('d-m-Y H:i:s');
	}

    function enviarPost()
    {
        if(isset($_POST['env']) && $_POST['env'] == "post")
        {
            $pdo = pdo();

            $subtitulo = tirarAcentos($_POST['titulo']);
            $data  =  getData();

            $uploaddir = '../IMGs/uploads/';
			$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

			$uploaddir2 = 'IMGs/uploads/';
			$uploadfile2 = $uploaddir2.basename($_FILES['userfile']['name']);

            if($_FILES['userfile']['size'] > 0)
            {
                $stmt = $pdo->prepare("INSERT INTO tblposts (Titulo_Posts, Subtitulo_Posts, Postagem_Posts, Imagem_Posts, Data_Posts, Categoria_Posts, ID_Postador) VALUES (:titulo, :subtitulo, :postagem, :imagem, :data, :categoria, :id_postador);");
                $stmt->execute([':titulo' => $_POST['titulo'], ':subtitulo' => $subtitulo, ':postagem' => $_POST['post'], ':imagem' => $uploadfile2,':data' => $data, ':categoria' => $_POST['categoria'], ':id_postador' => $_SESSION['admLogin']]);
                $total = $stmt->rowCount();

                if($total > 0)
                {
                    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
                    alerta("success", "Publicação realizada.");
                }
                else
                {
                    alerta("danger", "Erro ao realizar a publicação.");
                }
            }
            else
            {
                alerta("danger", "Por favor insira uma Imagem,");
            }
        }
    }

    function getNomeCategoria($id)
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("SELECT Cat_Categoria FROM tblcategoria WHERE ID_Categoria = :id ");
        $stmt->execute([':id' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        return $dados['Cat_Categoria'];        
    }

    function getDadosPost($id, $val)
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("SELECT * FROM tblposts WHERE ID_Posts = :id ");
        $stmt->execute([':id' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        return $dados[$val];        
    }

    function getCategoriaAtual($id)
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("SELECT * FROM tblcategoria WHERE ID_Categoria = :id ");
        $stmt->execute([':id' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        echo " <option value='{$dados['ID_Categoidria']}'>{$dados['Cat_Categoria']}(Atual)</option>";
              
    }

    function getPostAdmin()
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("SELECT * FROM tblposts ORDER BY ID_Posts DESC");
        $stmt->execute();
		$total = $stmt->rowCount();

        if($total > 0)
        {
            while($dados = $stmt->fetch(PDO::FETCH_ASSOC))
            {	
                echo "
                    <tr>
                        <td>{$dados['ID_Posts']}</td>
                        <td>{$dados['Titulo_Posts']}</td>
                        <td><span class='badge badge-primary'>".getNomeCategoria($dados['Categoria_Posts'])."</span></td>
                        <td>
                            <button id='btnGroupDrop1' type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Gerenciar</button>
                            <div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
                                <a class='dropdown-item bg-dark text-light' href='{$dados['Subtitulo_Posts']}' target='_blank'>Ver Publicação</a>
                                <a class='dropdown-item bg-info text-light' href='admin/editar-post/{$dados['ID_Posts']}'>Editar Publicação</a>
                               <a class='dropdown-item bg-danger text-light' href='admin/deletar-post/{$dados['ID_Posts']}'>Deletar Publicação</a>
                            </div>
                         </td>
                    </tr>"
                ;
            };
        }
    }

    function editarPost($id)
    {
        if(isset($_POST['env']) && $_POST['env'] == "alt")
        {
            $pdo = pdo();

            $subtitulo = tirarAcentos($_POST['titulo']);

            //$stmt = $pdo->prepare("UPDATE tblposts SET (Titulo_Posts = :titulo, Subtitulo_Posts = :subtitulo, Postagem_Posts =  :postagem, Imagem_Posts = :imagem, Categoria_Posts = :categoria); WHERE ID_Posts = :id ");
            //$stmt->execute([':titulo' => $_POST['titulo'], ':subtitulo' => $subtitulo, ':postagem' => $_POST['post'], ':imagem' => $uploadfile2, ':categoria' => $_POST['categoria']]);
            
            $stmt = $pdo->prepare("UPDATE tblposts SET Titulo_Posts = :titulo, Subtitulo_Posts = :subtitulo, Postagem_Posts = :postagem, Categoria_Posts = :categoria WHERE ID_Posts = :id ");
            $stmt->execute([':titulo' => $_POST['titulo'], ':subtitulo' => $subtitulo, ':postagem' => $_POST['post'], ':categoria' => $_POST['categoria'], ':id' => $id]);
            
            $total = $stmt->rowCount();

            if($total > 0)
            {
				alerta("success", "Publicação alterada!");
				redireciona(2, "admin/editar-post/{$id}");
			}
            else
            {
				alerta("danger", "Erro ao alterar");
			}
        }
    }

    function delete($tabela, $coluna, $id, $backpage)
    {
        $pdo = pdo();

        $stmt = $pdo->prepare("DELETE FROM ".$tabela." WHERE ".$coluna." = :id");
        $stmt->execute([':id' => $id]);
		$total = $stmt->rowCount();

        if($total <= 0)
        {
			alerta("danger", "Erro ao deletar");
		}
        else
        {
			redireciona(0, $backpage);
		}
    }

    function addCategoria()
    {
        if(isset($_POST['env']) && $_POST['env'] == "cat")
        {
            $pdo = pdo();

            $stmt = $pdo->prepare("INSERT INTO tblcategoria (Cat_Categoria) VALUES (:categoria)");
            $stmt->execute([':categoria' => $_POST ['categoria']]);
            $total = $stmt->rowCount();

            if($total > 0)
            {
                alerta("success", "Categoria cadastrada com sucesso!");
            }
            else
            {
                alerta("danger", "Erro ao cadastrar categoria");
            }
        }
    }

    function getCategoriasMenu()
    {
        $pdo = pdo();
       
        $stmt = $pdo->prepare("SELECT * FROM tblcategoria ORDER BY Cat_Categoria ASC");
        $stmt->execute();
		$total = $stmt->rowCount();

        if($total > 0)
        {
            while($dados = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo "<li>{$dados['Cat_Categoria']} <a href='admin/deletar-categoria/{$dados['ID_Categoria']}' class='btn btn-danger btn-sm float-right'>Deletar</a></li>";
            }
        }
    }

    function lauchModal($id, $nome, $mensagem){
		echo "<div class='modal fade' id='exampleModalCenter{$id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalCenterTitle'>{$nome} Comentou</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            {$mensagem}
                        </dixv>
                    </div>
                </div>
        </div>";
	}

    function selecionaComentariosAdm()
    {
        $pdo = pdo();
       
        $stmt = $pdo->prepare("SELECT * FROM tblcomentarios ORDER BY ID_Comentario DESC LIMIT 30");
        $stmt->execute();
		$total = $stmt->rowCount();

        if($total > 0)
        {
			while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                echo 
                    "<tr>
                        <td>{$dados['ID_Comentario']}</td>
                        <td>{$dados['Nome_Comentario']}}</td>
                        <td>02-07-2019 09:21</td>
                        <td>
                            <button  id='btnGroupDrop1' type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Gerenciar</button>
                            <div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
                            <a class='dropdown-item bg-dark text-light' data-toggle='modal' data-target='#exampleModalCenter{$dados['ID_Comentario']}'>Ver Comentário</a>
                                <a class='dropdown-item bg-dark text-light' href='{$dados['ID_PostComenterio']}' target='_blank'>Ver Comentário</a>
                                <a class='dropdown-item bg-danger text-light' href='admin/deletar-comentario/{$dados['ID_Cometnario']}'>Deletar Comentário</a>
                            </div>
                        </td>
                    </tr>"
                ;
            }
        }
    }
?>