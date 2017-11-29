var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var schema = new Schema({
    urlServidor: {type: String,required:true},
    puertoServidor:{type: Number, required: true},
    apiServudir:{type:String,required:true}
})
module.exports = mongoose.model('Server',schema);