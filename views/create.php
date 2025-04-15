<style>
    .card-form {
        border-radius: 20px;
        padding: 50px;
        background-color: gainsboro;
        margin: 50px;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .submit {
        font-size: 20px;
        padding: 5px;
        border-radius: 5px;
        border: none;
        margin-top: 50px;
        cursor: pointer;
    }


    .submit:hover {
        box-shadow: 2px 2px 4px gold;
    }
</style>

<div style="height: 70vh;display:flex;align-items:center;justify-content:space-around;flex-direction:column;">
    <h3>Upload file transaction</h3>
    <div class="card-form">
        <form action="/upload" method="post" enctype="multipart/form-data">
            <input type="file" name="transaction" id="transaction">
            <input type="submit" value="Upload" class="submit">
        </form>
    </div>
</div>