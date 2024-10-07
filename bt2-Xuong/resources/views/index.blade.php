<!doctype html>
<html lang="en">
    <head>
        <title>Báo Cáo Thu nhập </title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div
                class="table-responsive"
            >
                <table
                    class="table table-striped table-hover table-borderless table-primary align-middle"
                >
                    <thead class="table-light">
                        
                        <tr>
                            <th>Tổng Doanh thu tháng</th>
                            <th>Tổng chi phí</th>
                            <th>Lợi nhuận trước thuế</th>
                            <th>Thuế phải nộp</th>
                            <th>Lợi nhuận sau thuế</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr
                            class="table-primary"
                        >
                            <td>{{number_format($sales,2)}}</td>
                            <td>{{number_format($expenses,2)}}</td>
                            <td>{{number_format($profitBeforeTax,2)}}</td>
                            <td>{{number_format($tax,2)}}</td>
                            <td>{{number_format($profitAfterTax,2)}}</td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
