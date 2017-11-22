import React from 'react';
import {render, handleClick} from 'react-dom';
import {FilesByServer, ServeTitle} from './FilesByServer.jsx'
import {Table} from 'react-materialize'

class Tabla extends React.Component {

  constructor(props){ //Para consumir los servicios
  	super(props)
  	this.state = {
		  futureData : [],
	  }
		
  }

  componentDidMount(){
		alert(this.props.texto)//Espera a que el componente se termine de dibujar
  	fetch("/test?name="+this.props.texto) //Hago un fetch
  		.then((resp)=>resp.json())
  			.then((datos)=>{
  				this.setState({
					  futureData : datos,
					  
  				})
  			})
	}
	componentDidUpdate(){
		//alert(this.props.texto)//Espera a que el componente se termine de dibujar
  	fetch("/test?name="+this.props.texto) //Hago un fetch
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
	return(
		<Table>
			
			<thead>		 
				<tr>
					<th>Nombre del archivo</th>
					<th>Email del propietario</th>
					<th>Link de descarga</th>
					<th>Vista previa</th>
				</tr>
			</thead>	
			<tbody>	
				{childs}
			</tbody>
		</Table>
			)
  }
}
// class ActionLink extends React.Component {
	
// 	  constructor(props){ //Para consumir los servicios
// 		  super(props)
// 		  this.state = {isToggleOn: true};
		  
			 
// 		  this.handleClick = this.handleClick.bind(this);
// 	  }

// 	 handleClick() {
// 		this.setState(prevState => ({
// 			isToggleOn: !prevState.isToggleOn
// 		  }));
// 		  if(this.state.isToggleOn == true){
// 			return(
// 				render(<App/>, document.getElementById('app')
// 			  ))
// 		  }else{
// 				render(null, document.getElementById('app'))
// 		  }
// 	}
  
// 	render() {
// 		return (
// 		  <a onClick={this.handleClick} className="waves-effect waves-light btn">
// 			{this.state.isToggleOn ? 'Mostrar Archivos' : 'Ocultar Archivos'}
// 		  </a>
// 		);
// 	  }
// 	}
class NameForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {value: ''};

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(event) {
    this.setState({value: event.target.value});
  }

  handleSubmit(event) {	
							event.preventDefault();
							return(
								render(<Tabla texto={this.state.value}/>,document.getElementById('app')
								))
		
	}
	crearTabla(){
							alert(this.state.value)
		
	}

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
					<div className="input-field">
          <input id="search"  type="text" placeholder="Buscar" value={this.state.value} onChange={this.handleChange}/>
					<button onClick={() => this.crearTabla()}></button>
        	</div>
      </form>
    );
  }
}

	render(<NameForm/>, document.getElementById('link'));



