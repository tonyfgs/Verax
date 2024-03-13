package com.example.veraxapplication

import android.graphics.Paint.Align
import android.os.Bundle
import android.text.Layout
import android.view.Menu
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
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
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.ArrowBack
import androidx.compose.material.icons.filled.Favorite
import androidx.compose.material.icons.filled.Home
import androidx.compose.material.icons.filled.Menu
import androidx.compose.material.icons.filled.Person
import androidx.compose.material3.BottomAppBar
import androidx.compose.material3.CenterAlignedTopAppBar
import androidx.compose.material3.DropdownMenu
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.NavigationBarDefaults.containerColor
import androidx.compose.material3.Scaffold
import androidx.compose.material3.ScaffoldDefaults
import androidx.compose.material3.TopAppBarDefaults.topAppBarColors
import androidx.compose.material3.darkColorScheme
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.text.TextStyle
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp

// doc navBar: https://developer.android.com/reference/kotlin/androidx/compose/material3/package-summary#TopAppBar(kotlin.Function0,androidx.compose.ui.Modifier,kotlin.Function0,kotlin.Function1,androidx.compose.foundation.layout.WindowInsets,androidx.compose.material3.TopAppBarColors,androidx.compose.material3.TopAppBarScrollBehavior)
// doc compose, pleins de trucs: https://developer.android.com/jetpack/compose/text?hl=fr
//doc couleur background pas finie: https://developer.android.com/jetpack/compose/components/scaffold

class MainActivity : ComponentActivity() {
    // un truc vite fait pour avoir un visi
    var article = listOf("Thinkerview", "thinkerview.jgp", "Thinkerview est une chaîne youtube d'interview-débat")
    var theme = listOf("Economique","Culture","Politique","Faits divers")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
                TopBarVerax(theme = theme, article = article)
            // allez sur la doc de Scaffold sur Android Dev et si vous comprenez comment on doit faire bien ouej

        }
    }
}

// Il faudrait mettre ca dans un fichier appart mais je connais plus les conventions ...
@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun TopBarVerax(theme : List<String>, article : List<String>) {
    var leMenu by remember {
        mutableStateOf(false)
    }
    Row(
        Modifier.background(Color.Cyan)
    ) {
        Scaffold(
            topBar = {
                CenterAlignedTopAppBar(
                    title = {
                        Text(
                            text = "Verax",
                            style = TextStyle(fontSize = 35.sp),
                            color = colorResource(R.color.red),
                            textAlign = TextAlign.Center,
                            /*backcolor = topAppBarColors(
                                    containerColor = MaterialTheme.colorScheme.primaryContainer),*/ //version recommandée par le prof
                            modifier = Modifier.fillMaxWidth()
                        )
                    },
                    navigationIcon = {
                        IconButton(onClick = { /* action() */ }) {
                            Icon(
                                imageVector = Icons.Filled.ArrowBack,
                                contentDescription = "Retour",
                                Modifier.size(30.dp)
                            )
                        }
                    },
                    actions = {
                        IconButton(onClick = { leMenu = !leMenu }) {
                            Icon(
                                imageVector = Icons.Filled.Menu,
                                contentDescription = "Menu",
                                Modifier.size(35.dp)
                            )
                        }
                        DropdownMenu(
                            expanded = leMenu, onDismissRequest = { leMenu = false },
                            modifier = Modifier
                                .background(Color.hsl(0.08F, 1F, 0.96F))
                        ) {
                            theme.sorted().forEach {
                                DropdownMenuItem(
                                    text = {
                                        Text(
                                            it,
                                            style = TextStyle(fontSize = 25.sp),
                                            modifier = Modifier
                                                .padding(10.dp)
                                        )
                                    },
                                    onClick = { /* faut un moyen d'appeler une methode diff pour chaque, ca doit etre faisable facilement */ }
                                )
                            }
                        }
                    }

                )
            },
            bottomBar = {
                // Faudrait pouvoir faire un flex sur les boutons parce que là ils sont juste côte à côte
                BottomAppBar(containerColor = Color.Black, contentColor = Color.White) {
                    IconButton(onClick = { /*TODO*/ }) {
                        Icon(
                            imageVector = Icons.Filled.Home,
                            contentDescription = "Home",
                            Modifier.size(35.dp)
                        )
                    }
                    IconButton(onClick = { /*TODO*/ }) {
                        Icon(
                            imageVector = Icons.Filled.Person,
                            contentDescription = "Account",
                            Modifier.size(35.dp)
                        )
                    }
                }
            }
        ) { innerPadding ->
            Column(
                modifier = Modifier
                    .padding(innerPadding),
                verticalArrangement = Arrangement.spacedBy(16.dp),
            ) {
                AffichageUnArticle(article = article)

            }
        }
    }
}


@Composable
fun AffichageUnArticle(article : List<String>){
    Column {
        for(e in article){
            Text(text = e)
        }
    }
}
