package com.example.veraxapplication

import android.os.Bundle
import android.view.Menu
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Row
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MenuDefaults
import androidx.compose.material3.Scaffold
import androidx.compose.ui.graphics.Color
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.ui.res.colorResource
import androidx.compose.ui.tooling.preview.Preview

import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Favorite
import androidx.compose.material.icons.filled.Menu
import androidx.compose.material.icons.filled.Person
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.NavigationBarDefaults.containerColor
import androidx.compose.material3.Scaffold
import androidx.compose.material3.ScaffoldDefaults
import androidx.compose.material3.TopAppBarDefaults.topAppBarColors
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp

// doc navBar: https://developer.android.com/reference/kotlin/androidx/compose/material3/package-summary#TopAppBar(kotlin.Function0,androidx.compose.ui.Modifier,kotlin.Function0,kotlin.Function1,androidx.compose.foundation.layout.WindowInsets,androidx.compose.material3.TopAppBarColors,androidx.compose.material3.TopAppBarScrollBehavior)
// doc compose, pleins de trucs: https://developer.android.com/jetpack/compose/text?hl=fr
//doc couleur background pas finie: https://developer.android.com/jetpack/compose/components/scaffold

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            TopBarVerax()
        }
    }
}

//background = E6DFD9
// rouge = C34837

@OptIn(ExperimentalMaterial3Api::class)
@Preview
@Composable
fun TopBarVerax(){
    Row(
        modifier=Modifier.background(Color.White)  //marche pas
    ){

        Scaffold (
            topBar = {TopAppBar(
                title = { Text(text = "Verax",
                                color = colorResource(R.color.red),
                                textAlign = TextAlign.Center,
                                /*backcolor = topAppBarColors(
                                    containerColor = MaterialTheme.colorScheme.primaryContainer),*/ //version recommandée par le prof
                                modifier = Modifier
                                .fillMaxWidth()
                                .padding(horizontal = 16.dp, vertical = 30.dp)
                )},
            navigationIcon = {
                IconButton(onClick = { /* action() */ }) {
                    Icon(
                        imageVector = Icons.Filled.Menu,
                        contentDescription = "Economie"
                    )
                }
            },
            actions = {
                IconButton(onClick = { /* action() */ }) {
                    Icon(
                        imageVector = Icons.Filled.Person,
                        contentDescription = "Localized description"
                    )
                }
            }
            )}
        ){it
            Text(text = "coucou")
        }
    }
}