import React from 'react';
import {render} from 'react-dom';
import { Player } from 'video-react';
import {MediaBox} from 'react-materialize';


export class FilesByServer extends React.Component {

				render() {
							
								const serverData = this.props.data
								const serverName = serverData.server.hostname
								const server = serverData.server.origin
								var ordenado = serverData.data.sort(function (a, b){
									if (a.ubicacion_del_archivo.ext > b.ubicacion_del_archivo.ext) {
										return 1;
									  }
									  if (a.ubicacion_del_archivo.ext < b.ubicacion_del_archivo.ext) {
										return -1;
									  }
									  // a must be equal to b
									  return 0;
									});
								const tableList = ordenado.map(
									(dataFile) => 
										<tr key={dataFile.nombre_del_archivo.toString()}> 
											<td>{dataFile.nombre_del_archivo}</td>
											<td>{dataFile.ubicacion_del_archivo.ext}</td>
											{<td><a href={server + "/"+dataFile.ubicacion_del_archivo.path} className="waves-effect waves-light btn-large pulse">Descargar</a></td>/* <td><a href={server + dataFile.user_id +"/" + dataFile.name}>Descargar archivo</a></td> */}
											
											<td><Preview
												format={dataFile.ubicacion_del_archivo.ext}
												path={server + "/"+dataFile.ubicacion_del_archivo.path}/>
											</td>
										</tr>
								)
								return tableList

				}

}


export class Preview extends React.Component {
				

				render() {
					switch (this.props.format ){
					case ".JPG":return <MediaBox src={this.props.path} width="96"/>
					case ".jpeg" :return <MediaBox src={this.props.path} width="96"/>
					case ".png":return <MediaBox src={this.props.path} width="96"/>
					case ".docx":return <img className="img materialboxed"  src="https://lh4.ggpht.com/-wROmWQVYTcjs3G6H0lYkBK2nPGYsY75Ik2IXTmOO2Oo0SMgbDtnF0eqz-BRR1hRQg=w300"/>
					case ".rar":return <div>win rar</div>
				 	case ".mp3":return <Player
				 	 width={96}
				 	src={this.props.path}
				  	 />
				 	case ".mp4" : return  <Player 
				 	width={96}
				 	src={this.props.path}
				   />
					default : return <div>sin vista previa</div>
				}
								
				}

				
}



