<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>
    <form action={{ route('send.bank') }} method="post">
        @csrf
        <table>
            <tr>
                <div>
                    <label for="">مبلغ: </label>
                    <input type="text" name="amount">
                </div>
            </tr>
            <tr>
            <input type="submit" value="ارسال" >
            </tr>
        </table>
    </form>
</body>

</html>
