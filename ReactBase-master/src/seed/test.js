var MongoClient = require('mongodb').MongoClient
, assert = require('assert');

// Connection URL
var url = 'mongodb://localhost:27017/servers';

// Use connect method to connect to the server
MongoClient.connect(url, function(err, db) {
assert.equal(null, err);
console.log("Connected successfully to server");
createValidated(db,function(){
insertServers(db, function() {
    findServers(db, function() {
      db.close();
    });
  });
});

});
var insertServers = function(db, callback) {
    // Traigo la coleccion de servers
    var collection = db.collection('servers');
    // inserto algunos servidores
    collection.insertMany([
        {server : "localhost/", uri: "/api",puerto: 8000},
        {server : "10.10.10.1/", uri: "/getFileByTag", puerto :2000}
    ], function(err, result) {
      assert.equal(err, null);
      
      console.log("Servidores agregados a mongo");
      callback(result);
    });
  }
  var findServers = function(db, callback) {
    // Get the documents collection
    var collection = db.collection('servers');
    // Find some documents
    collection.find({},{_id:0}).toArray(function(err, docs) {
      assert.equal(err, null);
     // console.log("Found the following records");
      //console.log(docs[0].server)
      serverMap = docs;
      callback(docs);
    });
  }
  var createValidated = function(db, callback) {
    db.createCollection("contacts", 
         {
            'validator': { '$or':
               [
                  { 'phone': { '$type': "string" } },
                  { 'email': { '$regex': /@mongodb\.com$/ } },
                  { 'status': { '$in': [ "Unknown", "Incomplete" ] } }
               ]
            }
         },	   
      function(err, results) {
        console.log("Collection created.");
        callback();
      }
    );
  };