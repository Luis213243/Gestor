<?php 
session_start();
require_once "../../clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];
$sql = " SELECT  archivos.id_archivo as idArchivo,
				 usuario.nombre as nombreUsuario,
				 categorias.nombre as categoria,
				 archivos.nombre as nombreArchivo,
				 archivos.tipo as tipoArchivo,
				 archivos.ruta rutaArchivo,
				 archivos.fecha as fecha
		FROM t_archivos as archivos 
		inner join t_usuarios as usuario on 
				 archivos.id_usuarios = usuario.id_usuarios
		inner join t_categorias as categorias on 
				 archivos.id_categoria = categorias.id_categoria
		AND archivos.id_usuarios = '$idUsuario'";

$result = mysqli_query($conexion, $sql)
?>


<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover" id="tablaGestorDataTable">
				<thead style="text-align: center; background-color: #F00000; color: white">
					<tr>
						<th>Categoria</th>
						<th>Nombre</th>
						<th>Extension</th>
						<th>Descargar</th>
						<th>Visualizar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody style="text-align: center;">
					<?php 


						/*
							Arreglo de extensiones
						*/

							$extensionesValidas = array('png', 'jpg', 'pdf', 'mp3', 'mp4');

							while($mostrar = mysqli_fetch_array($result)) 
							{
								$rutaDescarga = "../archivos/".$idUsuario."/".$mostrar['nombreArchivo'];
								$nombreArchivo = $mostrar['nombreArchivo'];
								$idArchivo = $mostrar['idArchivo'];
								?>
								<tr>
									<td><?php echo $mostrar['categoria']; ?></td>
									<td><?php echo $mostrar['nombreArchivo']; ?></td>
									<td><?php echo $mostrar['tipoArchivo']; ?></td>
									<td>
										
										<a href="<?php echo $rutaDescarga ?>" download="<?php echo $nombreArchivo ?>" class="btn btn-success btn-sm">
											<span class="fas fa-download"></span>
										</a>
										
									</td>
									<td>
										<?php 
										for ($i=0; $i < count($extensionesValidas); $i++) { 
											if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) 
											{
										?>
												<span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#visualizarArchivo" onclick="obtenerArchivoPorId('<?php echo $idArchivo ?>')">
													<span class="fas fa-eye"></span>
												</span>
										<?php 			
											}
										}
										?>
									</td>
									<td style="text-align: center;">
										<span class="btn btn-danger btn-sm" 
										onclick="eliminarArchivo('<?php echo $idArchivo ?>')">
										<span class="fas fa-trash-alt"></span>
									</span>
								</td>
							</tr>
							<?php 
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#tablaGestorDataTable').DataTable();
		});
	</script>