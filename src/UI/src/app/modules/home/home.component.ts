import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  condominiumId: any;
  condominiumName = "Marina Park";
  cards = [
    {
      name: 'Moradores',
      total: "3200",
      icon: 'fa-light fa-users',
      color: 'rgb(0, 236, 207)'
    },
    {
      name: 'Despesas',
      total: "R$ 200,00",
      icon: 'fa-light fa-handshake-angle',
      color: 'rgb(255, 91, 91)'
    },
    {
      name: 'Receita',
      total: "R$ 300,00",
      icon: 'fa-regular fa-piggy-bank',
      color: 'rgb(9, 204, 6)'
    }
  ];

  constructor(private activatedRoute : ActivatedRoute) { }

  ngOnInit(): void {
    this.condominiumId = this.activatedRoute.snapshot.paramMap.get("id");
  }
}
