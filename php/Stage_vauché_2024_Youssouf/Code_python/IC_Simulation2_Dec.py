# -*- coding: utf-8 -*-
"""
Created on Wed Jul  3 10:27:20 2024

@author: yrd
"""


###########################--------------------------Simulation 1---------------------------------------------------
import pandas as pd
import numpy as np
import scipy.stats as stats
import matplotlib.pyplot as plt

excel_path = 'BDD.xlsx'
df = pd.read_excel(excel_path)

df_selected1 = df[['ID_carac_3', 'Sous-catégorie', 'Masse nette (kg)', '% éch.']].iloc[780:1224].dropna()
#df_selected1 = pd.concat([df_selected1,df_selected1,df_selected1])
df_selected1[['% éch.', 'Masse nette (kg)']] = df_selected1[['% éch.', 'Masse nette (kg)']].apply(pd.to_numeric, errors='coerce')
num_bacs = 12
num_categories = num_bacs
N = 1666360.00  # Masse totale disponible en kg pour l'ensemble du mois de décembre

mu_i = df_selected1.groupby('Sous-catégorie')['Masse nette (kg)'].mean()
p = df_selected1.groupby('Sous-catégorie')['% éch.'].mean()[:num_categories].values

# Multiplier par 1.5 pour les catégories "EMR" et "ELA
#categories_to_multiply = ["EMR", "ELA","Aluminiums","Papiers (1.11)","ELA","PET Clair Bouteilles / flacons","Refus"]
categories_to_multiply = ["EMR", "Papiers (1.11)","Acier","ELA"]
mu_i.loc[categories_to_multiply] = mu_i.loc[categories_to_multiply] * 2.5


#mu_i = df_selected2.groupby('Sous-catégorie')['Masse nette (kg)'].apply(lambda x: x.nlargest(3).mean()).values
#p = df_selected2.groupby('Sous-catégorie')['% éch.'].apply(lambda x: x.nlargest(3).mean()).values
mu = np.sum(mu_i * p)

# Niveaux de confiance et tailles d'échantillon à tester
confidence_level = 0.95 
z_value = stats.norm.ppf((1 + confidence_level) / 2)
#tailles_echantillon =[1147, 1652, 2052, 5233,6147, 9233, 1666360.00] # Tailles d'échantillon
points_fixes = np.array([1150,83319]) # 50121, 83319
# Génération des points supplémentaires entre 105000 et N, excluant 105000 puisqu'il est déjà inclus
points_supplementaires = np.linspace(100000, N, num=6)[1:]  # Ajustez le 'num' selon le nombre de points désirés
# Concaténation des deux séries de points
points_abscisse = np.concatenate((points_fixes, points_supplementaires))

etiquettes_x = [f"{int(x)}kg ({(x/N*100):.2f}%)" for x in points_abscisse]  # Etiquettes personnalisées
categories = df_selected1['Sous-catégorie'].unique()[:num_categories]
categories = np.sort(categories)

# Simulation
num_simulations = 10  # Nombre de simulations à effectuer
all_theta_hats = np.zeros((num_simulations, len(points_abscisse), len(categories), num_bacs))
all_ci_lowers = np.zeros_like(all_theta_hats)
all_ci_uppers = np.zeros_like(all_theta_hats)

# Simulation pour chaque taille d'échantillon
for sim in range(num_simulations):
    for n_idx, n in enumerate(points_abscisse):
        cov_matrix = np.zeros((num_categories, num_categories))
        for i in range(num_categories):
            for j in range(num_categories):
                if i == j:
                    cov_matrix[i, j] = (p[i] * mu_i[i]**2)/mu**2
                else:
                    cov_matrix[i, j] = (-p[i] * p[j] * mu_i[i] * mu_i[j])/mu**2
        cov_matrix /= n
        Z = np.random.multivariate_normal(np.zeros(len(categories)), cov_matrix, size=num_bacs)

        for i in range(len(categories)):
            for j in range(num_bacs):
                numerator = mu_i[i] * p[i] + mu * Z[j, i]
                denominator = mu * (1 + np.sum(Z[j, :]))
                theta_hat = numerator / denominator if denominator > 0 else 0

                std_error = np.sqrt((theta_hat * (1 - theta_hat)) / n)
                ci_lower = theta_hat - stats.norm.ppf(0.975) * std_error
                ci_upper = theta_hat + stats.norm.ppf(0.975) * std_error

                all_theta_hats[sim, n_idx, i, j] = theta_hat
                all_ci_lowers[sim, n_idx, i, j] = ci_lower
                all_ci_uppers[sim, n_idx, i, j] = ci_upper

# Calcul des moyennes des résultats de la simulation
mean_theta_hats = all_theta_hats.mean(axis=0)
mean_ci_lowers = all_ci_lowers.mean(axis=0)
mean_ci_uppers = all_ci_uppers.mean(axis=0)

# Affichage des résultats pour chaque taille d'échantillon et chaque catégorie
print(f"Résultats moyens après {num_simulations} simulations :\n{'-' * 60}")
for n_idx, n in enumerate(points_abscisse):
    pct = (n / N) * 100
    print(f"Taille d'échantillon = {n}kg ({pct:.2f}%)")
    for i, category in enumerate(categories):
        for j in range(num_bacs):
            print(f" {category}, Bac {j+1}: Estimateur = {mean_theta_hats[n_idx, i, j]:.4f}, "
                  f"IC = [{mean_ci_lowers[n_idx, i, j]:.4f}, {mean_ci_uppers[n_idx, i, j]:.4f}]")
    print('-' * 60)


# Tracé des graphiques pour chaque catégorie
for i, category in enumerate(categories):
    plt.figure(figsize=(12, 6))
    
    # Calcul des moyennes des bornes inférieures et supérieures pour chaque taille d'échantillon
    mean_ci_lower = mean_ci_lowers[:, i, :].mean(axis=1)
    mean_ci_upper = mean_ci_uppers[:, i, :].mean(axis=1)
    
    # Tracé de l'intervalle de confiance moyen
    plt.fill_between(points_abscisse, mean_ci_lower, mean_ci_upper, color='purple', alpha=0.3, label=f'IC moyen pour {category}')
    plt.plot(points_abscisse, mean_ci_lower, '-o', color='red', label='Borne inférieure moyenne')
    plt.plot(points_abscisse, mean_ci_upper, '-o', color='blue', label='Borne supérieure moyenne')

    # Configuration du graphique
    plt.title(f'Intervalle de confiance moyen pour {category} avec la taille de l\'échantillon')
    plt.xlabel('Taille de l\'échantillon (kg & %)(Simulation)')
    plt.ylabel('Intervalle de confiance (Dec_21)')
    plt.legend()
    plt.grid(True)
    plt.xticks(points_abscisse, etiquettes_x, rotation=45)
    
    # Ajout des étiquettes de taux de confiance pour chaque point d'abscisse
    for x in points_abscisse:
        idx = (np.abs(points_abscisse - x)).argmin()
        marge_erreur = (mean_ci_upper[idx] - mean_ci_lower[idx]) / 2
        # Affichage de la marge d'erreur
        taux_confiance = 100 - (marge_erreur / ((mean_ci_upper[idx] + mean_ci_lower[idx]) ) * 100)
       # Affichage du taux de confiance
        plt.text(x, mean_ci_upper[idx], f"{taux_confiance:.2f}%", ha='center', va='bottom', fontsize=8, color='black')
       
    plt.show()