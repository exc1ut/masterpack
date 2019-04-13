var request=[];
$('#postavshik').on('change', function loadItems(){

        var id = $(this).val(); //extract the id of selected category
        var shortname;


var ajax =  $.ajax({
    method : 'GET',
    dataType : 'text',
    url : '../site/select?id=' + id,
    success : function (response) {
        console.log(response);

        var response = JSON.parse(response);
        console.log(response);
        var myDropDownList = document.getElementsByClassName('selected');
        var length = myDropDownList.length;
        $( ".options" ).remove();
        for(var i=0;i<length;i++){
            $.each(response, function(index, value) {
                var option = document.createElement("option");
                option.text = value;
                option.value = index;
                option.className = "options"

                try {
                    myDropDownList[i].options.add(option);
                }
                catch (e) {
                    alert(e);
                }
            });
        }

    }

});
});

$('.selected').on('change',function loadDogovors() {

    console.log('123');
    var id = $(this).val(); //extract the id of selected category
    console.log(id);
     $.ajax({
        method: 'GET',
        dataType: 'text',
        url: '../site/getdogovor?id=' + id,
        success: function (response) {
            console.log(response);
            $('.optiondogovor').remove();
            var response = JSON.parse(response);
            var select = document.getElementsByClassName("odk");
            var length = select.length;
            console.log(select);
            for(var i=0;i<length;i++)
            {
            
            $.each(response, function (index, value) {

                var option = document.createElement("option");
                option.text = value;
                option.value = index;
                option.className = "optiondogovor"

                try {
                    select[i].options.add(option);
                }
                catch (e) {
                    alert(e);
                }
            });
            }
        }

    });
});



function addRow()
{


    fetch('http://myproject/site/getallitems').then(res => res.json()).then(json => {


    console.log(json);

    var input = document.getElementById('rownumb');


    var table = document.getElementById('table');
    var rownumb = input.value;

        function addTh(text)
        {
            var th = document.createElement('th');
            var p = document.createElement('p');
            var t = document.createTextNode(text);
            p.appendChild(t);
            th.appendChild(p);
            tr.appendChild(th);
        }

        // <th>Поставшик</th>
        // <th>Номер дата договора</th>
        // <th>Номер счет-фактуры</th>
        // <th>Тип</th>
        // <th>Вес</th>
        // <th>Формат</th>
        // <th>Дата</th>
        // <th>Время</th>


    $('#tbody').remove();
    var tbdy = document.createElement('tbody');
    tbdy.setAttribute('id','tbody');

        var tr = document.createElement('tr');
        addTh('Id')
        addTh('Поставшик')
        addTh('Номер дата договора')
        addTh('Номер счет-фактуры')
        addTh('Тип')
        addTh('Вес')
        addTh('Формат')
        addTh('Дата')
        addTh('Время')
        tbdy.appendChild(tr);

    for(var i=0;i<rownumb;i++)
    {
        var tr = document.createElement('tr');
        tr.setAttribute('data-target',i);
        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','id');
        select.setAttribute('name','id[]');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.id)
        {
            var option = document.createElement('option');
            option.text = json.id[key];
            option.value = json.id[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','client_id');
        select.setAttribute('name','postavshik_schet_faktura_id[]');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.clients)
        {
            var option = document.createElement('option');
            option.text = json.clients[key];
            option.value = json.clients[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','dogovor_id');
        select.setAttribute('name','kratkoe_naimenovanie[]');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.dogovor)
        {
            var option = document.createElement('option');
            option.text = json.dogovor[key];
            option.value = json.dogovor[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','schet');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.schet)
        {
            var option = document.createElement('option');
            option.text = json.schet[key];
            option.value = json.schet[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','tip_id');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.tip)
        {
            var option = document.createElement('option');
            option.text = json.tip[key];
            option.value =  json.tip[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','ves');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.ves)
        {
            var option = document.createElement('option');
            option.text = json.ves[key];
            option.value =  json.ves[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','format');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.format)
        {
            var option = document.createElement('option');
            option.text = json.format[key];
            option.value = json.format[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','date');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.date)
        {
            var option = document.createElement('option');
            option.text = json.date[key];
            option.value =  json.date[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','time');
        select.setAttribute('onchange','loadSortedItems(this,'+i+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.time)
        {
            var option = document.createElement('option');
            option.text = json.time[key];
            option.value = json.time[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        tr.appendChild(td);

        var td = document.createElement('td');
        var button = document.createElement('button');
        button.setAttribute('onclick','def(event,'+i+');');
        button.innerHTML = "Сброс";
        td.appendChild(button);
        tr.appendChild(td);

        tbdy.appendChild(tr);

    }

    table.appendChild(tbdy);
})
}




    function loadSortedItems(e,tr) {
    var dataName = e.getAttribute('data-name');
    request[tr] ? request[tr] += dataName + '=' + e.value + '&' : request[tr] = dataName + '=' + e.value + '&';
    console.log(request, tr);
    var url = 'http://myproject/site/getsorteditems?' + request[tr];
    console.log(url);
    fetch(url).then(res=>res.json()).then(json => {
        console.log(json)
        console.log(request);
        var row = $("[data-target = "+ tr +"]");
        row[0].innerHTML = "";

    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','id');
    select.setAttribute('name','id[]');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
    var count = Object.keys(json.schet);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.id)
    {
        var option = document.createElement('option');
        option.text = json.id[key];
        option.value =  json.id[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);



    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','client_id');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
    var count = Object.keys(json.client_name);
    var numb = count.length;
    console.log()
    if(numb > 1)
    {
        var option = document.createElement('option');
        option.value = "Выбрать";
        select.appendChild(option)
    }
    for(var key in json.client_name)
    {
        var option = document.createElement('option');
        option.text = json.client_name[key];
        option.value = json.client_name[key];
        select.appendChild(option);
        console.log(key);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);




    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','dogovor_id');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.dogovors);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.dogovors)
    {
        var option = document.createElement('option');
        option.text = json.dogovors[key];
        option.value = json.dogovors[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);

    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','schet');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.schet);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.schet)
    {
        var option = document.createElement('option');
        option.text = json.schet[key];
        option.value = json.schet[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }

    row[0].appendChild(td);

    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','tip_id');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.tip);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.tip)
    {
        var option = document.createElement('option');
        option.text = json.tip[key];
        option.value = json.tip[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }

    row[0].appendChild(td);


        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','ves');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.ves);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
        for(var key in json.ves)
        {
            var option = document.createElement('option');
            option.text = json.ves[key];
            option.value = json.ves[key];
            select.appendChild(option);
        }
        if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
        row[0].appendChild(td);


    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','format');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.format);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.format)
    {
        var option = document.createElement('option');
        option.text = json.format[key];
        option.value = json.format[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);


    row[0].appendChild(td);
    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','date');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.date);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.date)
    {
        var option = document.createElement('option');
        option.text = json.date[key];
        option.value =  json.date[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);

    var td = document.createElement('td');
    var select = document.createElement('select');
    select.setAttribute('data-name','time');
    select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var count = Object.keys(json.time);
        var numb = count.length;
        if(numb > 1)
        {
            var option = document.createElement('option');
            option.text = "Выбрать";
            select.appendChild(option)
        }
    for(var key in json.time)
    {
        var option = document.createElement('option');
        option.text = json.time[key];
        option.value = json.time[key];
        select.appendChild(option);
    }
    if(dataName !== select.getAttribute('data-name'))
    {
    td.appendChild(select);
    }
    else 
    {
        td.appendChild(e);
    }
    row[0].appendChild(td);

    var td = document.createElement('td');
        var button = document.createElement('button');
        button.setAttribute('onclick','def(event,'+tr+');');
        button.innerHTML = "Сброс";
        td.appendChild(button);
        row[0].appendChild(td);

        console.log(row);
    });}
    //Multi Select
$('#chkveg').multiselect({

    includeSelectAllOption: true
});
$('#format').multiselect({

    includeSelectAllOption: true
});

$('#btnget').click(function(){

    alert($('#chkveg').val());
});
    //Otchet function
    function addOtchet(model_name)
    {
        var clients = $('#chkveg').val().join(",");

        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var url = 'http://myproject/site/getotchet?client='+clients+'&start_date='+startDate+'&end_date='+endDate+'&model_name='+model_name;
        console.log(url);
        fetch(url).then(res=>res.json()).then(json => {
            console.log(json);

        function addTh(text)
        {
            var th = document.createElement('th');
            var t = document.createTextNode(text);
            th.appendChild(t);
            tr.appendChild(th);
        }
        function addColoumn(text)
        {
            var td = document.createElement('td');
            var t = document.createTextNode(text);
            td.appendChild(t);
            tr.appendChild(td);
        }
        var table = document.getElementById('table');
        var rownumb = json[0].length;

        $('#tbody').remove();
        var tbdy = document.createElement('tbody');
        tbdy.setAttribute('id','tbody');
        var tr = document.createElement('tr');
        addTh('Id');
        addTh('Поставщик');
        addTh('Договор');
        addTh('Номер счет фактуры');
        addTh('Тип');
        addTh('Вес');
        addTh('Формат');
        addTh('Дата');
        addTh('Время');
        addTh('Цена');
        tbdy.appendChild(tr);
        console.log('hello')

        var tr = document.createElement('tr');

        addColoumn('Итог');
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn(json[1].ves);
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn(json[1].cost);
        tbdy.appendChild(tr);


        for(var i=0;i<rownumb;i++)
        {
            var tr = document.createElement('tr');
            addColoumn(json[0][i].id);
            addColoumn(json[0][i].client);
            addColoumn(json[0][i].dogovor_nomer);
            addColoumn(json[0][i].schet);
            addColoumn(json[0][i].tip);
            addColoumn(json[0][i].ves);
            addColoumn(json[0][i].format);
            addColoumn(json[0][i].date);
            addColoumn(json[0][i].time);
            addColoumn(json[0][i].cost);


            tbdy.appendChild(tr);

        }
        var tr = document.createElement('tr');

        addColoumn('Итог');
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn(json[1].ves);
        addColoumn('');
        addColoumn('');
        addColoumn('');
        addColoumn(json[1].cost);
        tbdy.appendChild(tr);
            console.log(tbdy);
            table.appendChild(tbdy);

            $("#table").tableExport({formats: ["xlsx"]})

        });

    }
    function showTable()
    {
        var tip = $('#chkveg').val().join(",");
        var format = $('#format').val().join(",");
        var date = $('#dateTable').val();
        var url = 'http://myproject/site/gettable?format='+format+'&tip='+tip+'&date='+date;
        console.log(url);
        fetch(url).then(res => res.json()).then(json => {
            console.log(json);


            function addTh(text)
            {
                var th = document.createElement('th');
                var p = document.createElement('p');
                var t = document.createTextNode(text);
                p.appendChild(t);
                th.appendChild(p);
                tr.appendChild(th);
            }
            function addColoumn(text)
            {
                var td = document.createElement('td');
                var p = document.createElement('p');
                var t = document.createTextNode(text);
                p.appendChild(t);
                td.appendChild(p);
                tr.appendChild(td);
            }
            var table = document.getElementById('excelTable');

            $('tbody').remove();
            var tbdy = document.createElement('tbody');

            var tr = document.createElement('tr');
            addTh('Format/Tip');
            for(var key in json[1])
            {
                addTh(json[1][key]);
            }
            addTh('Total');
            tbdy.appendChild(tr);
            for(var key in json[0])
            {
                var tr = document.createElement('tr');
                for(var key2 in json[0][key]) {

                    addColoumn(json[0][key][key2]);

                }
                tbdy.appendChild(tr);
            }





            table.appendChild(tbdy);
            $("#table").tableExport({formats: ["xlsx"]});0



        })
    }

    function addPrihod(event)
    {
        event.preventDefault();
        

        $('#skladItem').clone().appendTo("#skladItems");
        

        // appendTo('#skladItems');
        // col2[0].appendChild($skladItems[0]);   
    }



function def(e,tr)
    {
        e.preventDefault();

        var url = 'http://myproject/site/getallitems';
    console.log(url);
    fetch(url).then(res=>res.json()).then(json => {
        console.log(json)
        console.log(request);
        var row = $("[data-target = "+ tr +"]");
        row[0].innerHTML = "";
        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','id');
        select.setAttribute('name','id[]');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.id)
        {
            var option = document.createElement('option');
            option.text = json.id[key];
            option.value = json.id[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','client_id');
        select.setAttribute('name','postavshik_schet_faktura_id[]');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.clients)
        {
            var option = document.createElement('option');
            option.text = json.clients[key];
            option.value = json.clients[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','dogovor_id');
        select.setAttribute('name','kratkoe_naimenovanie[]');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.dogovor)
        {
            var option = document.createElement('option');
            option.text = json.dogovor[key];
            option.value = json.dogovor[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','schet');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.schet)
        {
            var option = document.createElement('option');
            option.text = json.schet[key];
            option.value = json.schet[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','tip_id');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.tip)
        {
            var option = document.createElement('option');
            option.text = json.tip[key];
            option.value =  json.tip[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','ves');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.ves)
        {
            var option = document.createElement('option');
            option.text = json.ves[key];
            option.value =  json.ves[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','format');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.format)
        {
            var option = document.createElement('option');
            option.text = json.format[key];
            option.value = json.format[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','date');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.date)
        {
            var option = document.createElement('option');
            option.text = json.date[key];
            option.value =  json.date[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var select = document.createElement('select');
        select.setAttribute('data-name','time');
        select.setAttribute('onchange','loadSortedItems(this,'+tr+');');
        var option = document.createElement('option');
        option.text = "select";
        select.appendChild(option);
        for(var key in json.time)
        {
            var option = document.createElement('option');
            option.text = json.time[key];
            option.value = json.time[key];
            select.appendChild(option);
        }
        td.appendChild(select);
        row[0].appendChild(td);

        var td = document.createElement('td');
        var button = document.createElement('button');
        button.setAttribute('onclick','default(event,this,'+tr+');');
        button.innerHTML = "Сброс";
        td.appendChild(button);
        row[0].appendChild(td);

        
    })
    return false;

    }