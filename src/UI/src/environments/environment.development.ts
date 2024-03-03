export const environment = {
  image_test: 'https://portal.crea-sc.org.br/wp-content/uploads/2017/11/imagem-indisponivel-para-produtos-sem-imagem_15_5.jpg',
  menu: {
    employee: [
      {
        "description": "Inicio",
        "permissions": [],
        "screens": [],
        "url": "/home"
      },
      {
        "description": "Cadastros",
        "permissions": [],
        "screens": [
          {
            "description": "Apartamentos",
            "permissions": ["LIMITED_ACCESS_APARTMENT", "FULL_ACCESS_APARTMENT"],
            "screens": [],
            "url": "/cadastros/apartamentos"
          },
          {
            "description": "Áreas Comuns",
            "permissions": ["LIMITED_ACCESS_COMMON_AREAS", "FULL_ACCESS_COMMON_AREAS"],
            "screens": [],
            "url": "/cadastros/areas-comuns"
          },
          {
            "description": "Fornecedores",
            "permissions": ["LIMITED_ACCESS_SUPPLIERS", "FULL_ACCESS_SUPPLIERS"],
            "screens": [],
            "url": "/cadastros/fornecedores"
          },
          {
            "description": "Moradores",
            "permissions": ["LIMITED_ACCESS_FOR_RESIDENTS", "FULL_RESIDENT_ACCESS"],
            "screens": [],
            "url": "/cadastros/moradores"
          },
          {
            "description": "Perfis",
            "permissions": ["LIMITED_ACCESS_PROFILES", "FULL_ACCESS_PROFILES"],
            "screens": [],
            "url": "/cadastros/perfis"
          },
          {
            "description": "Produtos",
            "permissions": ["LIMITED_ACCESS_PRODUCTS", "FULL_ACCESS_PRODUCTS"],
            "screens": [],
            "url": "/cadastros/produtos"
          },
          {
            "description": "Visitantes",
            "permissions": ["LIMITED_ACCESS_VISITORS", "FULL_VISITOR_ACCESS"],
            "screens": [],
            "url": "/cadastros/visitantes"
          }
        ],
        "url": ""
      },
      {
        "description": "Entregas",
        "permissions": ["LIMITED_ACCESS_DELIVERIES", "FULL_ACCESS_DELIVERIES"],
        "screens": [],
        "url": "/entregas"
      },
      {
        "description": "Financeiro",
        "permissions": [],
        "screens": [
          {
            "description": "Contas à Pagar",
            "permissions": ["LIMITED_ACCESS_ACCOUNTS_PAYABLE", "FULL_ACCESS_ACCOUNTS_PAYABLE"],
            "screens": [],
            "url": "/financeiro/contas-a-pagar"
          },
          {
            "description": "Contas à Receber",
            "permissions": ["LIMITED_ACCESS_ACCOUNTS_RECEIVABLE", "FULL_ACCESS_ACCOUNTS_RECEIVABLE"],
            "screens": [],
            "url": "/financeiro/contas-a-receber"
          },
        ],
        "url": ""
      },
      {
        "description": "Recursos Humanos",
        "permissions": [],
        "screens": [
          {
            "description": "Cargos",
            "permissions": ["LIMITED_ACCESS_POSITIONS", "FULL_ACCESS_POSITIONS"],
            "screens": [],
            "url": "/recursos-humanos/cargos"
          },
          {
            "description": "Funcionários",
            "permissions": ["LIMITED_ACCESS_TO_EMPLOYEES", "FULL_EMPLOYEE_ACCESS"],
            "screens": [],
            "url": "/recursos-humanos/funcionários"
          },
          {
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
