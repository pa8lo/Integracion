import React from 'react';
import {render, handleClick} from 'react-dom';
import {FilesByServer, ServeTitle} from './FilesByServer.jsx'
import {Servidor} from './MyCounter.jsx'
import {Example} from './boots.jsx'
import {Table} from 'reactstrap';

class App extends React.Component {

  constructor(props){ //Para consumir los servicios
  	super(props)
  	this.state = {
		  futureData : [],
	  }
	
  }

  componentDidMount(){//Espera a que el componente se termine de dibujar
  	fetch("/test") //Hago un fetch
  		.then((resp)=>resp.json())
  			.then((datos)=>{
  				this.setState({
					  futureData : datos,
					  
  				})
  			})
  }

  render () {
	  const childs = this.state.futureData.map( (dataByServer) =>
	   <FilesByServer key={dataByServer.toString()} data={dataByServer}  /> )
	return <tbody>
				 
				<tr>
					<th>Nombre del archivo</th>
					<th>Email del propietario</th>
					<th>Link de descarga</th>
					<th>Vista previa</th>
				</tr>
				{childs}
			</tbody>
  }
}




class ActionLink extends React.Component {
	
	  constructor(props){ //Para consumir los servicios
		  super(props)
		  this.state = {isToggleOn: true};
		  
			 
		  this.handleClick = this.handleClick.bind(this);
	  }

	 handleClick() {
		this.setState(prevState => ({
			isToggleOn: !prevState.isToggleOn
		  }));
		  if(this.state.isToggleOn == true){
			return(
				render(<App/>, document.getElementById('app')
			  ))
		  }else{
				render(null, document.getElementById('app'))
		  }
	}
  
	render() {
		return (
		  <a onClick={this.handleClick} className="waves-effect waves-light btn">
			{this.state.isToggleOn ? 'Mostrar Archivos' : 'Ocultar Archivos'}
		  </a>
		);
	  }
	}

	render(<ActionLink/>, document.getElementById('link'));



