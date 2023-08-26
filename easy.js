        function B(id){
            return document.querySelector(id);
        }
        B('.acc').addEventListener('click', function(ev) {B('.bat').style.display = 'block';B('.bat').style.zIndex = '1';});
		B('.n').addEventListener('click', ()=>{B('.inp').style.display = 'block';B('.su').style.display = 'block';});
		B('.c').addEventListener('click', ()=>{B('.in').style.display = 'block';B('.su').style.display = 'block';});
    	B('.spb').addEventListener('click', ()=>{B('.bat').style.display = 'none';});
    	B('.stroke').addEventListener('click', ()=>{B('.init').style.display = 'block';B('.init').style.zIndex = '1';});
    	B('.spa').addEventListener('click', ()=>{B('.init').style.display = 'none';});
   		B('.cont').addEventListener('click', ()=>{alert('Whatsapp: 9478642832\nMail: peakme@peakme.in');});