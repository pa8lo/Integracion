//var Server = require('../models/servers');
var mongoose = require('mongoose');
var Schema = mongoose.Schema;
mongoose.connect('mongodb://localhost/servidores', { useMongoClient: true });
var schema = new Schema({
    urlServidor: {type: String,required:true},
    puertoServidor:{type: Number, required: true},
    apiServerdir:{type:String,required:true}
})

var Server = mongoose.model('Server',schema);

var servers = new Server({
    urlServidor: "localhost:",
    puertoServidor:8000,
    apiServerdir:"/api"

})
// var done = 0 ;
// for (let i = 0; i < servers.length; i++) {
//     servers[i].save()
    
    
// }
servers.save();

mongoose.disconnect();
  
