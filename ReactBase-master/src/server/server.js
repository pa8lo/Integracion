"use sctrict"
const fecth = require('node-fetch')
const express = require('express')
const bodyParser = require('body-parser')
const path = require('path')
const urls = require('url-parse')
var util  = require('util');
const server = express()
const parsePath =require("parse-filepath")
var mongoose = require('mongoose');
mongoose.connect('mongodb://localhost:27017/servers', { useMongoClient: true });
console.log()
const baseFolder = path.resolve(__dirname, '../client/')

server.use("/",express.static(baseFolder))
server.use("/test2",express.static(baseFolder))

server.use(bodyParser.json())
var urlss;
function futureResp(url,query){

	return	fecth(url) //Hago un fetch al puerto de Laravel
	      .then(function(res) { //La respuesta que me llega entra en el parametro de la funcion
	        return res.json() //Retorna un json de la rta
	      })
	      .then(function(data) {
				
					urlss =urls (url,true)
					console.log(data.length)
					data.forEach(function(archivo) {
					archivo.ubicacion_del_archivo= parsePath(archivo.ubicacion_del_archivo)
					console.log(archivo.ubicacion_del_archivo)
					}, this);
	      	return Promise.resolve({"server":urlss,"data":data}) //Esto me permite identificar la url de la cual esta llegando la informacion
	      })
}

//Array con las urls de donde vienen los datos
const servers = ['http://localhost:8000/getFileByTagName'] 
server.get("/getFileByTagName",(req,resp)=>{
	
var filtrados = servers.map(function(x) {
		return x +"?name="+req.query.name;
	})
	console.log(req.query.name)
  const calls = filtrados.map(futureResp) //Transformo el array de urls en promesas
  Promise.all(calls) //Se va a ejecutar el resto cuando todas las promesas esten listas
	 .then(function(data) { //De esa devolucion lo pasa como paramentro en la funcion 
	        console.log("Leyendo la información del server")
	        console.log(data) 
	        resp.json(data) //te hace un json
	      })
  
})


server.listen(8080,function (){
  console.log("Server levantado en el puerto 8080")
})
