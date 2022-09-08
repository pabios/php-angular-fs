import {NgModule} from "@angular/core";
import {RouterModule, Routes} from "@angular/router";
import {AuthGuard} from "../core/guards/auth.guard";
import {ChannelComponent} from "./channel/channel.component";

const routes: Routes =[
  // {path:'create',component:NewFaceSnapComponent},
  // { path: ':id', component: SingleFaceSnapComponent,canActivate:[AuthGuard] },
  // { path: ':id', component: SingleFaceSnapComponent },
  // { path: '', component: FaceSnapListComponent },
  {path: 'chat',component:ChannelComponent,canActivate:[AuthGuard]}
]
@NgModule(
  {
    imports: [
      RouterModule.forChild(routes)
    ],
    exports: [
      RouterModule
    ]
  }
)
export class ChatRoutingModule {

}
