<!DOCTYPE html>
<style>
        @page{margin: 0in 0in 0in 0in;}
        body { 
        background: url('{{public_path('/consImages/TIMBRADO.jpg')}}') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding:20px;
        }
        table{
            margin-top: 8em;
        }
  
    </style>
<html>
    <body>
            <table>
            <tbody>
                <tr>
                    <td colspan="3" style="padding: 10px; border: 1px solid #dddddd; ">Informação Confidencial <br> Uso exclusivo da empresa associada para auxílio na aprovação de crédito. A divulgação de tais informações a terceiros
                    sujeitará o infrator as sanções penais.</td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Consulta</td>
                </tr>
                </tbody>
            </table>       
        <h1>{{ $title }}</h1>
        <p>{{ $date }}</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </body>
</html>