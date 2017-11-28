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

	updateList(filter){
  	fetch("/api?name="+filter) //Hago un fetch
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
			this.props.onUpdate(this.state.value)
	}


  render() {
    return (
      <form onSubmit={(e) => this.handleSubmit(e)}>
					<div className="input-field">
          <input id="search"  type="text" placeholder="Buscar" value={this.state.value} onChange={this.handleChange}/>
        	</div>
      </form>
    );
  }
}

class App extends React.Component {

	constructor(props){
		super(props)
	}
	
	render(){
		return <div>
						<nav>
							<NameForm onUpdate={(filter)=> this.refs.tabla.updateList(filter)} />
						</nav>
						<Tabla ref="tabla" />
					</div>
	}
}

render(<App/>, document.getElementById('app'));



