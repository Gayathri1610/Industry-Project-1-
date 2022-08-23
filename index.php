<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title>Convert Excel to HTML Table using JavaScript</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container">
    	<h2 class="text-center mt-4 mb-4">Upload an Excel and  view  as a table</h2>
    	<div class="card">
    		<div class="card-header"><b>Select Excel File</b></div>
    		<div class="card-body">
    			
                <input type="file" id="excel_file" />

    		</div>
    	</div>
        <div id="excel_data" class="mt-5"></div>
    </div>
</body>
</html>

<script>

const excel_file = document.getElementById('excel_file');

excel_file.addEventListener('change', (event) => {

   
    var reader = new FileReader();

    reader.readAsArrayBuffer(event.target.files[0]);

    reader.onload = function(event){

        var data = new Uint8Array(reader.result);

        var work_book = XLSX.read(data, {type:'array'});

        var sheet_name = work_book.SheetNames;

        var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});

        if(sheet_data.length > 0)
        {
            var table_output = '<table class="table table-striped table-bordered">';

            for(var row = 0; row < sheet_data.length; row++)
            {

                table_output += '<tr>';

                for(var cell = 0; cell < sheet_data[row].length; cell++)
                {

                   
                        table_output += '<th>'+sheet_data[row][cell]+'</th>';


                      

                }

                table_output += '</tr>';

            }

            table_output += '</table>';

            document.getElementById('excel_data').innerHTML = table_output;
        }

       

    }

});


