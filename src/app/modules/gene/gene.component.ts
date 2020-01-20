import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Subscription} from 'rxjs';
import {ApiService} from '../../core/services/api.service';
import {Genes, Origin} from '../../core/models';

@Component({
  selector: 'app-gene',
  templateUrl: './gene.component.html',
  styleUrls: ['./gene.component.scss']
})
export class GeneComponent implements OnInit {

  public id: number;
  private subscription: Subscription;
  public gene: Genes;

  constructor(private activateRoute: ActivatedRoute,
              private apiService: ApiService) {
    this.subscription = activateRoute.params.subscribe(params => this.id = params.id);
  }

  ngOnInit() {
    this.getGene();
  }

  private getGene() {
    this.apiService.getGeneById(this.id).subscribe((gene) => {
      this.gene = gene;
    });
  }

}
