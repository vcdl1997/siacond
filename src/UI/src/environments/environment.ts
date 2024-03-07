export const environment = {
  image_test: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAAAAAA77wXdAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAACYktHRAD/h4/MvwAAAAd0SU1FB+gDBhcJKzAf4b8AAAH7SURBVDjLpdU/i8IwFADw++JJGqtgETwFF0Ho2FJw8gsUpYLg0qnWSYUrOIhQxaFScs2fek2beFcug9T6M3lJXl4+SIv28T+c38+H/f5wvue/4WcSuBOr2+l0rYkbfD3f4CxyLAggREWDxUPfiTIdPjkmYLBsEJjOSYmz9QCgRgODddbEjwWGojtgYGwAMQjEi0cdP+ZiZDR0/TCOw6U3MsRI84eMs4Wg081FLFl+3c4w14tMwmv2Gvb9W3X2qc1DwesqPg3oWziO5e1Z9URsg9MPzhzA7LFmzXIhgZO9cGSyGGKlZR9mVOIn6xj5Kgt7NmZdPwVO+sVrOL2prLlKZ0VX0EoEDthIG7XNydagTwHHuUv/+nnRWHIdFc/AzRm+T8ovSktyj3Y2uTN8tij2dZaQJQv6zPChW/xihFpLQhp098DwvkN3NNZaEtPF6+wVuGnJroKlMBRWCoNPcKm1xK9MkC+dl+ss3wexdPzL6Kqx5DKsbArfbmOrsWSDKtvNEwnMUrW9TWE1kXiKYrunssRHUory5OdZ3rAxHbaS/OJYKe1xDGvHShzYovXq/TIrHdiyFCBop9LcfBZDrRSURQbh2fZaFpnLZsrnUS8yr/IFjJG3DONd6LtDQRvlq11hbFdySatiTtpdE6R+ASXvLiC+ZH++2t63VvgbvAcebwt3T2EAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjQtMDMtMDZUMjM6MDk6MzQrMDA6MDB6i7rmAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDI0LTAzLTA2VDIzOjA5OjM0KzAwOjAwC9YCWgAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyNC0wMy0wNlQyMzowOTo0MyswMDowMJOhFBIAAAAASUVORK5CYII=',
  menu: {
    employee: [
      {
        "icon": "fa-regular fa-house-chimney",
        "description": "Inicio",
        "permissions": [],
        "screens": [],
        "url": "/home"
      },
      {
        "icon": "fa-solid fa-plus",
        "description": "Cadastros",
        "permissions": [],
        "screens": [
          {
            "icon": "fa-regular fa-apartment",
            "description": "Apartamentos",
            "permissions": ["LIMITED_ACCESS_APARTMENT", "FULL_ACCESS_APARTMENT"],
            "screens": [],
            "url": "/cadastros/apartamentos"
          },
          {
            "icon": "fa-regular fa-circles-overlap",
            "description": "Áreas Comuns",
            "permissions": ["LIMITED_ACCESS_COMMON_AREAS", "FULL_ACCESS_COMMON_AREAS"],
            "screens": [],
            "url": "/cadastros/areas-comuns"
          },
          {
            "icon": "fa-regular fa-building-user",
            "description": "Fornecedores",
            "permissions": ["LIMITED_ACCESS_SUPPLIERS", "FULL_ACCESS_SUPPLIERS"],
            "screens": [],
            "url": "/cadastros/fornecedores"
          },
          {
            "icon": "fa-regular fa-user",
            "description": "Moradores",
            "permissions": ["LIMITED_ACCESS_FOR_RESIDENTS", "FULL_RESIDENT_ACCESS"],
            "screens": [],
            "url": "/cadastros/moradores"
          },
          {
            "icon": "fa-regular fa-address-card",
            "description": "Perfis",
            "permissions": ["LIMITED_ACCESS_PROFILES", "FULL_ACCESS_PROFILES"],
            "screens": [],
            "url": "/cadastros/perfis"
          },
          {
            "icon": "fa-brands fa-product-hunt",
            "description": "Produtos",
            "permissions": ["LIMITED_ACCESS_PRODUCTS", "FULL_ACCESS_PRODUCTS"],
            "screens": [],
            "url": "/cadastros/produtos"
          },
          {
            "icon": "fa-regular fa-id-badge",
            "description": "Visitantes",
            "permissions": ["LIMITED_ACCESS_VISITORS", "FULL_VISITOR_ACCESS"],
            "screens": [],
            "url": "/cadastros/visitantes"
          }
        ],
        "url": ""
      },
      {
        "icon": "fa-regular fa-truck",
        "description": "Entregas",
        "permissions": ["LIMITED_ACCESS_DELIVERIES", "FULL_ACCESS_DELIVERIES"],
        "screens": [],
        "url": "/entregas"
      },
      {
        "icon": "fa-regular fa-money-bill-transfer",
        "description": "Financeiro",
        "permissions": [],
        "screens": [
          {
            "icon": "fa-regular fa-file-invoice-dollar",
            "description": "Contas à Pagar",
            "permissions": ["LIMITED_ACCESS_ACCOUNTS_PAYABLE", "FULL_ACCESS_ACCOUNTS_PAYABLE"],
            "screens": [],
            "url": "/financeiro/contas-a-pagar"
          },
          {
            "icon": "fa-solid fa-cash-register",
            "description": "Contas à Receber",
            "permissions": ["LIMITED_ACCESS_ACCOUNTS_RECEIVABLE", "FULL_ACCESS_ACCOUNTS_RECEIVABLE"],
            "screens": [],
            "url": "/financeiro/contas-a-receber"
          },
        ],
        "url": ""
      },
      {
        "icon": "fa-solid fa-users",
        "description": "Recursos Humanos",
        "permissions": [],
        "screens": [
          {
            "icon": "fa-solid fa-suitcase",
            "description": "Cargos",
            "permissions": ["LIMITED_ACCESS_POSITIONS", "FULL_ACCESS_POSITIONS"],
            "screens": [],
            "url": "/recursos-humanos/cargos"
          },
          {
            "icon": "fa-regular fa-user-tie-hair",
            "description": "Funcionários",
            "permissions": ["LIMITED_ACCESS_TO_EMPLOYEES", "FULL_EMPLOYEE_ACCESS"],
            "screens": [],
            "url": "/recursos-humanos/funcionários"
          },
          {
            "icon": "fa-solid fa-envelope-open-dollar",
            "description": "Holerites",
            "permissions": ["LIMITED_ACCESS_PAYS", "FULL_ACCESS_PAYS"],
            "screens": [],
            "url": "/recursos-humanos/holerites"
          },
        ],
        "url": ""
      },
    ]
  }
};
