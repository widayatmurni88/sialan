(() => {
  let tbl = document.querySelector('#myGrid');
  const columnDefs = [{
      headerName: "Make",
      field: "make"
    },
    {
      headerName: "Model",
      field: "model"
    },
    {
      headerName: "Price",
      field: "price"
    }
  ];
  const rowData = [{
    make: "Toyota",
    model: "Celica",
    price: 35000
  }, {
    make: "Ford",
    model: "Mondeo",
    price: 32000
  }, {
    make: "Porsche",
    model: "Boxter",
    price: 72000
  }];

  const gridOption = {
    columnDefs: columnDefs,
    rowData: rowData
  }

  let grid = new agGrid.Grid(tbl, gridOption);
  let gridApi = grid.gridOptions.api;
})();
