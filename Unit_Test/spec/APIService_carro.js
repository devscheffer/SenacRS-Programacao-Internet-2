// describe("mocking ajax", function() {

//   describe("read_item_id", function() {
//        beforeEach(function() {
//     jasmine.Ajax.install();
//   });
//   afterEach(function() {
//     jasmine.Ajax.uninstall();
//   });

//   it("Deve checar o retorno do id", function() {
//     var doneFn = jasmine.createSpy('success');
//     jasmine.Ajax.withMock(function() {
//       var xhr = new XMLHttpRequest();
//       xhr.onreadystatechange = function(args) {
//         if (this.readyState == this.DONE) {
//           doneFn(this.responseText);
//         }
//       };

// 	    const uri = "http://localhost:8000/api/carro";
//       const id = '1N4CL3APXEC115380';
      
//       xhttp.open("GET", uri+'/'+id, true);
      
//       xhr.send();

//       expect(doneFn).not.toHaveBeenCalled();

//       jasmine.Ajax.requests.mostRecent().respondWith({
//         "status": 200,
//         "responseText": 'in spec response'
//       });

//       expect(doneFn).toHaveBeenCalledWith('in spec response');
//     });
//   });
// });








describe("read_item_id", function() {

  const read = new APIService_Carro();
  var ok;

  beforeEach(function() {

  });
  
  it("Deve checar o retorno do id", function() {
    read.read_item_id('1N4CL3APXEC115380',function(
      carro
    ){
      expect(carro.chassi).toEqual('1N4CL3APXEC115380');
    },function(error){})

  });
  
});
